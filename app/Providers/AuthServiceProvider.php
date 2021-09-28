<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = array(
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    );

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Permission::get()->map( function ( $permission ) {
            Gate::define(
                $permission->slug,
                function ( $user ) use ( $permission ) {
                    return $user->has_permission_to( $permission );
                }
            );
        } );
    }
}
