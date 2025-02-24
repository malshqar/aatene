<?php

namespace App\Providers;

use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Features;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerFortifyGaurdsConfig();

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        if (request()->is('login') || request()->is('register')) {
            abort(404);
        }
    }

    public function registerFortifyGaurdsConfig(): void
    {
        $request = request();
        if ($request->is('api/*')) {
            // config()->set("auth.guards.seller.driver", 'jwt');
            // config()->set("auth.guards.admin.driver", 'jwt');
        }
        if (
            ((in_array('dashboard', $request->segments()))
                && ('dashboard' == $request->segments()[0])) || $request->is('dashboard/*')
        ) {
            config()->set('auth.defaults.guard', 'admin');
            config()->set('fortify.guard', 'admin');
            config()->set('fortify.passwords', 'admins');
            config()->set('fortify.home', '/dashboard');
            config()->set('fortify.prefix', '/dashboard');
            config()->set('fortify.features', [
                Features::resetPasswords(),
                Features::emailVerification(),
                // Features::updatePasswords(),
                
            ]);

        }
        if (
            (
                ((in_array('store', $request->segments()))
                    && ('store' == $request->segments()[0])) || $request->is('store/*')
            )
        ) {
            config()->set('auth.defaults.guard', 'seller');
            config()->set('fortify.guard', 'seller');
            config()->set('fortify.passwords', 'sellers');
            config()->set('fortify.home', '/store');
            config()->set('fortify.prefix', '/store');
            config()->set('fortify.features', [
                Features::resetPasswords(),
                Features::emailVerification(),
                // Features::registration(),
                // Features::updatePasswords(),
                
            ]);
        }

    }
}
