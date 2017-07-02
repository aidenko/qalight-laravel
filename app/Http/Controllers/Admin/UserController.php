<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Store;
use App\Http\Requests\Admin\User\Update;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list() {
        if(Auth::user()->can('viewList', User::class))
            return view('themes.admin.html.user.users', ['users' => User::all()]);

        return redirect()->route('admin.no-access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if(Auth::user()->can('create', User::class)){
            return view('themes.admin.html.user.new', [
                'roles' => Role::all()
            ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\Store $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request) {

        if(Auth::user()->can('create', User::class)){
            $user = User::create($request->all());

            $user->roles()->sync($request->roles, false);

            return redirect()->route('admin.user.show', $user->id);
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

        $user = User::find($id);

        dd($user->comments);

        if(Auth::user()->can('view', $user)){

            return view('themes.admin.html.user.user', [
                'user' => $user,
                'permissions' => $user->permissions()
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

        $user = User::find($id);

        if(Auth::user()->can('update', $user)){
            return view('themes.admin.html.user.edit', [
                'user' => $user,
                'roles' => Role::all(),
                'user_roles' => $user->roles->pluck('id'),
                'permissions' => Permission::all(),
                'rp' => $user->role_permissions()->pluck('id'),
                'up' => $user->immediate_permissions->pluck('pivot.include', 'id')
            ]);
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\User\Update $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, $id) {
        $user = User::find($id);


        if($user && Auth::user()->can('update', $user)){

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

        $user = User::find($id);

        if($user && Auth::user()->can('delete', $user)){
            User::destroy($id);

            return redirect()->route('admin.users.list');
        }
        else {
            return redirect()->route('admin.no-access');
        }
    }
}
