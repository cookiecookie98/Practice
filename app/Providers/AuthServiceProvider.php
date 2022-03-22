<?php

namespace App\Providers;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define('delete', function (User $user) {
            if($user->role_id == 1)
            {
                return true;
            }
        });
        Gate::define('create', function (User $user) {
            if($user->role_id == 1)
            {
                return true;
            }
        });
        Gate::define('edit', function (User $user) {
            if($user->role_id == 1)
            {
                return true;
            }
        });

        Gate::define('view', function (User $user) {
            if($user->role_id == 1 || $user->role_id == 2)
            {
                return true;
            }
        });
    }

    // Gate::define('')


}
