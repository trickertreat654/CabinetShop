<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Features;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Menu\MenuItem;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use App\Nova\Customer;
use App\Nova\Account;
use App\Nova\CabinetJob;
use App\Nova\Trip;

use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        Nova::withBreadcrumbs();


        Nova::mainMenu(function (Request $request) {
            return [
                // MenuSection::dashboard(Main::class)->icon('chart-bar'),
    
                MenuSection::make('Customers', [
                    MenuItem::resource(Account::class),
                    MenuItem::resource(Customer::class),
                ])->icon('user')->collapsable(),
    
                MenuSection::make('Work', [
                    MenuItem::resource(CabinetJob::class),
                    MenuItem::resource(Trip::class),
                ])->icon('document-text')->collapsable(),
            ];
        });

        //
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
                'trickertreat654@gmail.com',
                'cabinetsbyjohn@yahoo.com',
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
