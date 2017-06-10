<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('themes.admin.html.article.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required',
            'article' => 'required'
        ]);

        $article = new Article();

        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->content = $request->article;
        $article->slug = str_slug(uniqid().'-'.$request->title);
        $article->active = (boolean)$request->active;

        $article->save();

        return redirect()->route('articles.show', $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('themes.admin.html.article.article', ['article' => Article::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('themes.admin.html.article.edit')->withArticle(Article::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'summary' => 'required',
            'article' => 'required'
        ]);

        $article = Article::find($id);

        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->content = $request->article;
        $article->slug = str_slug(uniqid().'-'.$request->title);
        $article->active = (boolean)$request->active;

        $article->save();

        return redirect()->route('articles.show', $article->id);
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
}
