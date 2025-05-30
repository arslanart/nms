<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Model::class => Policy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //  Gate
        Gate::define('admin-menu', function ($user) {
            return $user->user_type === 'Admin';
        });

        Gate::define('admin-create-group', function ($user) {
            return $user->user_type === 'Admin';
        });

        Gate::define('admin-create-device', function ($user) {
            return $user->user_type === 'Admin';
        });

        Gate::define('admin-edit-menu', function ($user) {
            return $user->user_type === 'Admin';
        });

        Gate::define('admin-delete', function ($user) {
            return $user->user_type === 'Admin';
        });
    }
}
