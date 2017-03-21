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

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Languages
        Gate::define('language_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('language_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('language_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Cities
        Gate::define('city_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Localized city data
        Gate::define('localized_city_datum_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('localized_city_datum_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('localized_city_datum_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('localized_city_datum_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('localized_city_datum_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Players
        Gate::define('player_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('player_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: City steps
        Gate::define('city_step_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_step_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_step_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('city_step_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
