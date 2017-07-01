<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        if(Auth::user()->can('viewList', Permission::class))
            return view('themes.admin.html.permission.permissions', ['permissions' => Permission::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Auth::user()->can('create', Permission::class)){
            return view('themes.admin.html.permission.new');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Permission\StorePermissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request) {

        if(Auth::user()->can('create', Permission::class)){
            $permission = Permission::create($request->all());

            return redirect()->route('admin.permission.show', $permission->id);
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

        $permission = Permission::find($id);

        if(Auth::user()->can('view', $permission)){
            return view('themes.admin.html.permission.permission', ['permission' => $permission]);
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

        $permission = Permission::find($id);

        if(Auth::user()->can('update', $permission)){
            return view('themes.admin.html.permission.edit', ['permission' => $permission]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Permission\UpdatePermissionRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id) {
        $permission = Permission::find($id);

        if($permission && Auth::user()->can('update', $permission)){
            $permission->name = $request->name;
            $permission->description = $request->input('description');

            $permission->save();

            return redirect()->route('admin.permission.show', $id);
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

        $permission = Permission::find($id);

        if($permission && Auth::user()->can('delete', $permission)){
            Permission::destroy($id);

            return redirect()->route('admin.permissions.list');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }
}
