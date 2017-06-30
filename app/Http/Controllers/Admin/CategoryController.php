<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\Store;
use App\Http\Requests\Admin\Category\Update;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        if(Gate::allows('articles.view.list'))
            return view('themes.admin.html.category.categories', ['categories' => Category::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Auth::user()->can('create', Category::class)){
            return view('themes.admin.html.category.new', ['categories' => Category::all()]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Category\Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request) {

        if(Auth::user()->can('create', Category::class)){
            $category = $this->save($request);

            return redirect()->route('admin.category.show', $category->id);
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

        $category = Category::find($id);

        if(Auth::user()->can('view', $category)){

            return view('themes.admin.html.category.category',
                ['category' => $category,
                 'parent' => $category->parent
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

        $category = Category::find($id);

        if(Auth::user()->can('update', $category)){

            return view('themes.admin.html.category.edit',
                [
                    'category' => $category,
                    'categories' => Category::whereNotIn('id', array_merge([$id], $category->descendants->pluck('id')->toArray()))->get()
                ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Category\Update $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id) {

        $category = Category::find($id);

        if($category && Auth::user()->can('update', $category)){

            $this->save($request, $category);

            return redirect()->route('admin.category.show', $id);
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

        $category = Category::find($id);

        if($category && Auth::user()->can('delete', $category)){

            Category::destroy($id);

            return redirect()->route('admin.categories.list');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * @param CategoryRequest $request
     * @param \App\Category $category
     * @return Category
     */
    private function save(CategoryRequest $request, $category = null) {

        if(is_null($category))
            $category = new Category();

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;

        $category->save();

        return $category;
    }
}
