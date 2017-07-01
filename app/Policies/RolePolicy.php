<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy{
    use HandlesAuthorization;

    public function before(User $user) {
        if($user->isSuperAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the list of roles.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewList(User $user) {
        return $user->hasPermission('roles.view.list');
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function view(User $user, Role $role) {
        return ($user->hasPermission('roles.view.any'));
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->hasPermission('roles.create');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function update(User $user, Role $role) {
        return ($user->hasPermission('roles.edit.any') && !$role->isSuperAdmin()
            || $user->hasPermission('roles.edit.admin.super'));
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param  \App\User $user
     * @param  \App\Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role) {
        return ($user->hasPermission('roles.delete.any') && !$role->isSuperAdmin()
            || $user->hasPermission('roles.delete.admin.super'));
    }
}
