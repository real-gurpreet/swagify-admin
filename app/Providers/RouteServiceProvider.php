<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapApiRolesManagerRoutes();
        $this->mapApiBrandRoutes();
        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api/v1/auth.php'));
    }

    /**
     * Define routes for api v1 routes
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRolesManagerRoutes()
    {
        Route::prefix('api')
             ->middleware(['api', 'auth:api'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api/v1/roles.php'));
    }

    /**
     * Define brand-category-subCategory for api v1 routes
     *
     * These routes are typically stateless.
     * @return void
     */

    protected function mapApiBrandRoutes()
    {
        Route::prefix('api')
             ->middleware(['api', 'auth:api'])
             ->namespace($this->namespace)
             ->group(base_path('routes/api/v1/brand.php'));
    }


}
