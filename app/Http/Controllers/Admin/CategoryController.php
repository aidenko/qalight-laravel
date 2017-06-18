<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Controllers\Controller;

class CategoryController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('themes.admin.html.category.categories', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.category.new', ['categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        $category = $this->save($request);

        return redirect()->route('categories.show', $category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $category = Category::find($id);

        return view('themes.admin.html.category.category',
            ['category' => $category,
             'parent' => $category->parent
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $category = Category::find($id);

        return view('themes.admin.html.category.edit',
            [
                'category' => $category,
                'categories' => Category::whereNotIn('id', array_merge([$id], $category->descendants->pluck('id')->toArray()))->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CategoryRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id) {

        $this->save($request, $id);

        return redirect()->route('categories.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Category::destroy($id);

        return redirect()->route('categories.index');
    }

    /**
     * @param CategoryRequest $request
     * @param null $id
     * @return Category
     */
    private function save(CategoryRequest $request, $id = null) {

        if(is_null($id))
            $category = new Category();
        else
            $category = Category::find($id);

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;

        $category->save();

        return $category;
    }
}
