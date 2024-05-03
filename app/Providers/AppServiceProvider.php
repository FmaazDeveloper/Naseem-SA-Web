<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\ContactInformation;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // view()->composer(
        //     'layouts.app',
        //     function ($view) {
        //         $view
        //             ->with('ContactInformation', ContactInformation::find(1))
        //             ->with('AdministrativeRegion', AdministrativeRegion::where('is_active', true)->count())
        //             ->with('Region', Region::where('is_active', true)->count())
        //             ->with('Landmark', Landmark::where('is_active', true)->count())
        //             ->with('Activity', Activity::where('is_active', true)->count());
        //     }
        // );
    }
}
