<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('themes.admin.html.tag.tags', ['tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.tag.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return redirect()->route('tags.show', $this->save($request)->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('themes.admin.html.tag.tag', ['tag' => Tag::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('themes.admin.html.tag.edit')->withTag(Tag::find($id));
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

        return redirect()->route('tags.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Tag::destroy($id);

        return redirect()->route('tags.index');
    }

    private function save(Request $request, $id = null) {
        $this->validate($request, [
            'name' => 'required|max:64|unique:tags'
        ]);

        if(is_null($id))
            $tag = new Tag();
        else
            $tag = Tag::find($id);

        $tag->name = $request->name;;

        $tag->save();

        return $tag;
    }
}
