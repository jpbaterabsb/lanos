<?php

namespace App\Providers;

use App\Policies\AuthorizationPolicy;
use App\User;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => AuthorizationPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //validate if is admin to side menu.
        Gate::define('is-admin', function ($user) {

            if ($user->nivel == 'ADMIN'){
                return true;
            }

            return false;

        });
        //
    }
}
