<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy{
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
        return $user->hasPermission('articles.view.list');
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User $user
     * @param  \App\Article $article
     * @return mixed
     */
    public function view(User $user, Article $article) {
        return ($user->hasPermission('articles.view.any') || $article->isOwner($user));
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user) {
        return $user->hasPermission('articles.create');
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User $user
     * @param  \App\Article $article
     * @return mixed
     */
    public function update(User $user, Article $article) {
        return ($user->hasPermission('articles.edit.any')
            || ($user->hasPermission('articles.edit.own') && $user->isOwnerOf($article)));
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User $user
     * @param  \App\Article $article
     * @return mixed
     */
    public function delete(User $user, Article $article) {
        return ($user->hasPermission('articles.delete.any')
            || ($user->hasPermission('articles.delete.own') && $user->isOwnerOf($article)));
    }
}
