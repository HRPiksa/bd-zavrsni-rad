<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         *
         * Dio koda koji je potrebno zakomentirati prije pokretanja naredbe : composer install
         */
        view()->composer( 'home.*', function ( $view ) {
            $view->with( 'pages', \App\Models\Page::defaultOrder()->withDepth()->get()->toTree() );
        } );
        /**
         * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
         */
    }
}
