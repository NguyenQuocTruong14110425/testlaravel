<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->registerPostPolicies();
    }
    public function registerPostPolicies()
    {
        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin('admin')) {
                return true;
            }
        });

        Gate::define('employee', function ($user) {
            return $user->hasAnyRole(['employee']);
        });
        Gate::define('manager', function ($user) {
            return $user->hasAnyRole(['manager']);
        });
    }
}
