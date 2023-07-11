<?php

namespace App\Providers;

use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        // Gate

        Gate::define('auth', function () {
            $result = auth()->check() === true;
            return $result;
        });
        Gate::define('admin_superadmin', function () {
            switch (Auth::user()->getRoleNames()->first()) {
                case 'admin':
                    $result = true;
                    break;
                case 'superadmin':
                    $result = true;
                    break;

                default:
                    $result = false;
                    break;
            }
            return $result;
        });


        //
    }
}
