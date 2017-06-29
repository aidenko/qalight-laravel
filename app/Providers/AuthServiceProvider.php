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

        Gate::define('admin.view.dashboard', function(User $user) {
            return $user->hasPermission('admin.view.dashboard');
        });

        Gate::resource('articles', ArticlePolicy::class);
        Gate::resource('articles', ArticlePolicy::class, [
            'view.list' => 'viewList'
        ]);
    }
}
