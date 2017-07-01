<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

;

class RoleController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {

        if(Auth::user()->can('viewList', Role::class))
            return view('themes.admin.html.role.roles', ['roles' => Role::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Auth::user()->can('create', Role::class)){
            return view('themes.admin.html.role.new', [
                'roles' => Role::all(),
                'permissions' => Permission::all()
            ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Role\StoreRoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request) {

        if(Auth::user()->can('create', Role::class)){
            $role = $this->save($request);

            $role->permissions()->sync($request->permissions, false);

            return redirect()->route('admin.role.show', $role->id);
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
        $role = Role::find($id);

        if(Auth::user()->can('view', $role)){
            return view('themes.admin.html.role.role',
                ['role' => $role,
                 'parent' => $role->parent,
                 'permissions' => $role->permissions
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
        $role = Role::find($id);

        if(Auth::user()->can('update', $role)){
            return view('themes.admin.html.role.edit',
                [
                    'role' => $role,
                    'roles' => Role::whereNotIn('id', array_merge([$id], $role->descendants->pluck('id')->toArray()))->get(),
                    'permissions' => Permission::all(),
                    'role_permissions' => $role->permissions->pluck('id')
                ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\Role\UpdateRoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, $id) {

        $role = Role::find($id);

        if($role && Auth::user()->can('update', $role)){

            $this->save($request, $role)
                ->permissions()->sync($request->permissions);

            return redirect()->route('admin.role.show', $id);
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

        $role = Role::find($id);

        if($role && Auth::user()->can('delete', $role)){
            Role::destroy($id);

            return redirect()->route('admin.roles.list');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * @param FormRequest $request
     * @param null $role
     * @return Role
     */
    private function save(FormRequest $request, $role = null) {

        if(is_null($role))
            $role = new Role();

        $role->name = $request->name;
        $role->parent_id = $request->parent_id;
        $role->active = (boolean)$request->active;

        $role->save();

        return $role;
    }
}
