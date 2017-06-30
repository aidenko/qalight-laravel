<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy{
    use HandlesAuthorization;

    public function before(User $user) {
        if($user->isSuperAdmin())
            return true;
    }

    /**
     * Determine whether the user can view the list of articles.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function viewList(User $user) {
        return $user->hasPermission('users.view.list');
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User $user
     * @param  \App\User $check_user
     * @return mixed
     */
    public function view(User $user, User $check_user) {
        return ($user->hasPermission('users.view.any'));
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->hasPermission('users.create');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User $user
     * @param  \App\User $check_user
     * @return mixed
     */
    public function update(User $user, User $check_user) {
        !$check_user->isSuperAdmin() && $user->hasPermission('users.edit.any');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User $user
     * @param  \App\User $check_user
     * @return mixed
     */
    public function delete(User $user, User $check_user) {
        return !$check_user->isSuperAdmin() && $user->hasPermission('users.delete.any');
    }
}
