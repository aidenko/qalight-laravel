<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
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
        return view('themes.admin.html.category.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
        return view('themes.admin.html.category.category', ['category' => Category::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('themes.admin.html.category.edit')->withCategory(Category::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

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

    private function save(Request $request, $id = null) {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

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
