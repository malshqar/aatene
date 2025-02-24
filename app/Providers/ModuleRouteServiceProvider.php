<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ModuleRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->mapApiModuleRoutes();
        $this->mapWebDashboardModuleRoutes();
        $this->mapWebStoreDashboardModuleRoutes();
    }


    protected function mapApiModuleRoutes()
    {
        $modules = ['User', 'Admin', 'AccessControl', 'Seller', 'Store']; // Replace with your module names

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
        $modules = ['User', 'Admin', 'AccessControl', 'Seller', 'Dashboard']; // An array of your module names, if you have such a configuration

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
