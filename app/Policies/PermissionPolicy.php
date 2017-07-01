<?php

namespace App\Policies;

use App\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy{
    use HandlesAuthorization;

    public function before(User $user) {
        if($user->isSuperAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the list of permissions.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewList(User $user) {
        return $user->hasPermission('permissions.view.list');
    }

    /**
     * Determine whether the user can view the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function view(User $user, Permission $permission) {
        return ($user->hasPermission('permissions.view.any'));
    }

    /**
     * Determine whether the user can create permissions.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can update the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function update(User $user, Permission $permission) {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can delete the permission.
     *
     * @param  \App\User $user
     * @param  \App\Permission $permission
     * @return mixed
     */
    public function delete(User $user, Permission $permission) {
        return $user->isSuperAdmin();
    }
}
