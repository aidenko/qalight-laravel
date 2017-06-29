<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\Store;
use App\Http\Requests\Admin\Article\Update;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
    public function list($from = 0, $amount = 10) {

        if(Gate::allows('articles.view.list'))
            return view('themes.admin.html.article.articles', ['articles' => Article::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        if(Auth::user()->can('create', Article::class)){
            return view('themes.admin.html.article.new', array(
                'tags' => Tag::all(),
                'categories' => Category::all(),
                'authors' => User::all(),
                'user' => Auth::user()
            ));
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Article\Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request) {


        if(Auth::user()->can('create', Article::class)){
            $article = $this->save($request);
            $article->tags()->sync($request->tags);

            return redirect()->route('admin.article.show', $article->id);
        }
        else
            return redirect()->route('admin.no-access');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $article = Article::find($id);

        //The very wierd bug that Gate::allows() does not work if a policy registered
        if(Auth::user()->can('view', $article)){
            return view('themes.admin.html.article.article',
                [
                    'article' => $article,
                    'tags' => $article->tags,
                    'category' => $article->category
                ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $article = Article::find($id);

        if(Auth::user()->can('update', $article)){
            $tags = Tag::all();

            return view('themes.admin.html.article.edit',
                array(
                    'article' => $article,
                    'tags' => $tags,
                    'assigned' => $article->tags->pluck('id'),
                    'categories' => Category::all(),
                    'authors' => User::all()
                ));
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Article\Update $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id) {

        $article = Article::find($id);

        if($article && Auth::user()->can('update', $article)){
            $this->save($request, $article)->tags()->sync($request->tags);

            return redirect()->route('admin.article.show', $id);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $article = Article::find($id);

        if($article && Auth::user()->can('delete', $article)){

            Article::destroy($id);

            return redirect()->route('admin.articles');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * @param  Request $request
     * @param null \App\Article $article
     * @return Article
     */
    private function save(Request $request, $article = null) {

        if(is_null($article))
            $article = new Article();

        $article->title = $request->title;
        $article->summary = $request->summary;
        $article->content = $request->article;
        $article->active = (boolean)$request->active;
        $article->category_id = $request->category_id;

        if($article->user_id === null)
            $article->user_id = Auth::user()->id;

        $article->author_id = $request->author_id;

        $article->save();

        return $article;
    }
}
