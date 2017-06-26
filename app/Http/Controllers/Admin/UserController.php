<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Permission;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        return view('themes.admin.html.user.users', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('themes.admin.html.user.new', [
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request) {
        $user = User::create($request->all());

        $user->roles()->sync($request->roles, false);

        return redirect()->route('admin.user.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $user = User::find($id);

        return view('themes.admin.html.user.user', [
            'user' => $user,
            'permissions' => $user->permissions()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $user = User::find($id);

        return view('themes.admin.html.user.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'user_roles' => $user->roles->pluck('id'),
            'permissions' => Permission::all(),
            'rp' => $user->role_permissions()->pluck('id'),
            'up' => $user->immediate_permissions->keyBy('id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateUserRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id) {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->roles()->sync($request->roles);

        $permissions = [];

        foreach($request->input('p_incl', []) as $p)
            $permissions[$p] = ['include' => true];

        foreach($request->input('p_excl', []) as $p)
            $permissions[$p] = ['include' => false];

        $user->immediate_permissions()->sync($permissions);

        $user->save();

        return redirect()->route('admin.user.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::destroy($id);

        return redirect()->route('admin.users.list');
    }
}
