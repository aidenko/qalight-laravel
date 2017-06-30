<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\Store;
use App\Http\Requests\Admin\Tag\Update;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        if(Gate::allows('tags.view.list'))
            return view('themes.admin.html.tag.tags', ['tags' => Tag::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Auth::user()->can('create', Tag::class)){
            return view('themes.admin.html.tag.new');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Tag\Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request) {
        if(Auth::user()->can('create', Tag::class)){

            $tag = $this->save($request);

            return redirect()->route('admin.tag.show', $tag->id);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $tag = Tag::find($id);

        if(Auth::user()->can('view', $tag)){
            return view('themes.admin.html.tag.tag', ['tag' => $tag]);
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

        $tag = Tag::find($id);

        if(Auth::user()->can('update', $tag)){
            return view('themes.admin.html.tag.edit')->withTag($tag);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Tag\Update $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id) {

        $tag = Tag::find($id);

        if($tag && Auth::user()->can('update', $tag)){

            $this->save($request, $tag);

            return redirect()->route('admin.tag.show', $id);
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

        $tag = Tag::find($id);

        if($tag && Auth::user()->can('delete', $tag)){
            Tag::destroy($id);

            return redirect()->route('admin.tags.list');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * @param Request $request
     * @param null $tag
     * @return Tag
     */
    private function save(Request $request, $tag = null) {

        if(is_null($tag))
            $tag = new Tag();

        $tag->name = $request->name;;

        $tag->save();

        return $tag;
    }
}
