<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class RoleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        return view('themes.admin.html.role.roles', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.role.new', [
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request) {
        $role = $this->save($request);

        $role->permissions()->sync($request->permissions, false);

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
             'parent' => $role->parent,
             'permissions' => $role->permissions
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
                'roles' => Role::whereNotIn('id', array_merge([$id], $role->descendants->pluck('id')->toArray()))->get(),
                'permissions' => Permission::all(),
                'role_permissions' => $role->permissions->pluck('id')
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
        $role = $this->save($request, $id);

        $role->permissions()->sync($request->permissions);

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
