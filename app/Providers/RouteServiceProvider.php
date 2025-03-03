<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/store';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(maxAttempts: 60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        $this->mapApiModuleRoutes();
        $this->mapWebDashboardModuleRoutes();
        // $this->mapWebStoreDashboardModuleRoutes();
    }


    protected function mapApiModuleRoutes()
    {
        $modules = ['User', 'Admin', 'AccessControl', 'Seller', 'Store','Auth','Followers','Ads']; // Replace with your module names

        foreach ($modules as $module) {
            $modulePath = base_path("Modules/{$module}/Routes/api.php");
            if (file_exists($modulePath)) {
                Route::prefix('api/v1') // Add 'api/v1' prefix here
                    ->middleware('api')
                    ->namespace("Modules\\{$module}\\Http\\Controllers")
                    ->group($modulePath);
            }
        }
    }

    protected function mapWebDashboardModuleRoutes()
    {
        $modules = ['User', 'Admin', 'AccessControl', 'Seller','Dashboard','Store','ads']; // An array of your module names, if you have such a configuration

        foreach ($modules as $module) {
            $modulePath = base_path("Modules/{$module}/Routes/web.php");
            if (file_exists($modulePath)) {
                Route::middleware(['web', 'auth:admin', 'verified'])
                    ->prefix('dashboard')
                    ->name('dashboard.')
                    ->namespace("Modules\\{$module}\\Http\\Controllers")
                    ->group($modulePath);
            }
        }
    }

    protected function mapWebStoreDashboardModuleRoutes()
    {
        $modules = ['User', 'Seller', 'StoreDashboard']; // An array of your module names, if you have such a configuration

        foreach ($modules as $module) {
            $modulePath = base_path("Modules/{$module}/Routes/store.php");
            if (file_exists($modulePath)) {
                Route::middleware(['web', 'auth:seller', 'verified'])
                    ->prefix('store')
                    ->name('store.')
                    ->namespace("Modules\\{$module}\\Http\\Controllers")
                    ->group($modulePath);
            }
        }
    }

}
