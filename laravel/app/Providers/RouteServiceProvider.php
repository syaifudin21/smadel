<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

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
        Route::prefix('sekolah')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/sekolah.php'));
        Route::prefix('pengurus')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/pengurus.php'));
        Route::prefix('pengajar')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/pengajar.php'));
        Route::prefix('siswa')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/siswa.php'));
        Route::prefix('layanan')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/layanan.php'));
        Route::prefix('data')
             ->namespace($this->namespace)
             ->group(base_path('routes/data.php'));
        Route::prefix('v1')
             ->namespace($this->namespace)
             ->group(base_path('routes/v1.php'));
        Route::prefix('v2')
             ->namespace($this->namespace)
             ->group(base_path('routes/v2.php'));
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
             ->group(base_path('routes/api.php'));
    }
}
