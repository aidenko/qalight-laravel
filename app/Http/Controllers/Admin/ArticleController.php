<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\Admin\ArticleRequest;
use App\Tag;
use App\Http\Controllers\Controller;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('themes.admin.html.article.articles', ['articles' => Article::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.article.new', array('tags' => Tag::all(), 'categories' => Category::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request) {

        $article = $this->save($request);
        $article->tags()->sync($request->tags);

        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $article = Article::find($id);

        return view('themes.admin.html.article.article',
            [
                'article' => $article,
                'tags' => $article->tags,
                'category' => $article->category
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $article = Article::find($id);
        $tags = Tag::all();

        return view('themes.admin.html.article.edit',
            array(
                'article' => $article,
                'tags' => $tags,
                'assigned' => $article->tags->pluck('id'),
                'categories' => Category::all()
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\ArticleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id) {

        $this->save($request, $id)->tags()->sync($request->tags);

        return redirect()->route('articles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Article::destroy($id);

        return redirect()->route('articles.index');
    }

    /**
     * @param  \App\Http\Requests\Admin\ArticleRequest $request
     * @param null $id
     * @return Article
     */
    private function save(ArticleRequest $request, $id = null) {

        if(is_null($id))
            $article = new Article();
        else
            $article = Article::find($id);

        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->content = $request->article;
        $article->slug = str_slug(uniqid().'-'.$request->title);
        $article->active = (boolean)$request->active;
        $article->category_id = $request->category_id;

        $article->save();

        return $article;
    }
}
