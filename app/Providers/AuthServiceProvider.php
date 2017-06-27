<?php

namespace App\Providers;

use App\Article;
use App\Policies\ArticlePolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Gate::define('view_admin_dashboard', function(User $user) {
            return $user->hasPermission('view_admin_dashboard');
        });

        Gate::resource('articles', 'ArticlePolicy');

        Gate::define('articles.viewList', function(User $user) {
            return $user->hasPermission('articles.viewList');
        });
    }
}
