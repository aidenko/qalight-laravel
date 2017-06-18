<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TagRequest;
use App\Tag;
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
     * @param  \App\Http\Requests\Admin\TagRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request) {
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
     * @param  \App\Http\Requests\Admin\TagRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id) {

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

    /**
     * @param TagRequest $request
     * @param null $id
     * @return Tag
     */
    private function save(TagRequest $request, $id = null) {
        if(is_null($id))
            $tag = new Tag();
        else
            $tag = Tag::find($id);

        $tag->name = $request->name;;

        $tag->save();

        return $tag;
    }
}
