<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Policies\ArticlePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\TagPolicy;
use App\Tag;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Article::class => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('admin.view.dashboard', function(User $user) {
            return $user->hasPermission('admin.view.dashboard');
        });

        Gate::define('articles.view.list', 'App\Policies\ArticlePolicy@viewList');
        Gate::define('categories.view.list', 'App\Policies\CategoryPolicy@viewList');
        Gate::define('tags.view.list', 'App\Policies\TagPolicy@viewList');
    }
}
