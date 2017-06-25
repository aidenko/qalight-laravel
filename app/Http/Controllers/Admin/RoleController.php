<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;

class RoleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('themes.admin.html.role.roles', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.role.new', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request) {
        $role = $this->save($request);

        return redirect()->route('admin.role.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $role = Role::find($id);

        return view('themes.admin.html.role.role',
            ['role' => $role,
             'parent' => $role->parent
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $role = Role::find($id);

        return view('themes.admin.html.role.edit',
            [
                'role' => $role,
                'roles' => Role::whereNotIn('id', array_merge([$id], $role->descendants->pluck('id')->toArray()))->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateRoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id) {
        $this->save($request, $id);

        return redirect()->route('admin.role.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Role::destroy($id);

        return redirect()->route('admin.roles.list');
    }

    /**
     * @param FormRequest $request
     * @param null $id
     * @return Role
     */
    private function save(FormRequest $request, $id = null) {

        if(is_null($id))
            $role = new Role();
        else
            $role = Role::find($id);

        $role->name = $request->name;
        $role->parent_id = $request->parent_id;
        $role->active = (boolean)$request->active;

        $role->save();

        return $role;
    }
}
