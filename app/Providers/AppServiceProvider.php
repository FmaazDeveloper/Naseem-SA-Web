<?php

namespace App\Providers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\ContactInformation;
use App\Models\ContactReasons;
use App\Models\Landmark;
use App\Models\Order;
use App\Models\Region;
use App\Models\Ticket;
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

        //administrative_regions main style
        view()->composer(
            'admins.administrative_regions.main',
            function ($view) {
                $administrativeRegionsActive = AdministrativeRegion::where('is_active', '=', 1)->count();
                $administrativeRegionsUnactive = AdministrativeRegion::where('is_active', '=', 0)->count();

                $regionsActive = Region::where('is_active', '=', 1)->count();
                $regionsUnactive = Region::where('is_active', '=', 0)->count();

                $landmarksActive = Landmark::where('is_active', '=', 1)->count();
                $landmarksUnactive = Landmark::where('is_active', '=', 0)->count();

                $activitiesActive = Activity::where('is_active', '=', 1)->count();
                $activitiesUnactive = Activity::where('is_active', '=', 0)->count();

                $contentCount = $regionsActive + $regionsUnactive + $landmarksActive + $landmarksUnactive + $activitiesActive + $activitiesUnactive;

                $view
                    ->with('regionsActive', $regionsActive)
                    ->with('regionsUnactive', $regionsUnactive)
                    ->with('administrativeRegionsActive', $administrativeRegionsActive)
                    ->with('administrativeRegionsUnactive', $administrativeRegionsUnactive)
                    ->with('landmarksActive', $landmarksActive)
                    ->with('landmarksUnactive', $landmarksUnactive)
                    ->with('activitiesActive', $activitiesActive)
                    ->with('activitiesUnactive', $activitiesUnactive)
                    ->with('contentCount', $contentCount);
            }
        );

        //orders main style
        view()->composer(
            'admins.orders.main',
            function ($view) {
                $all_orders = Order::all();
                $complete_orders = Order::where('status', 'completed')->count();
                $active_orders = Order::where('status', 'actived')->count();
                $pending_orders = Order::where('status', 'pending')->count();
                $cancel_orders = Order::where('status', 'cancelled')->count();
                $reject_orders = Order::where('status', 'rejected')->count();

                $view
                    ->with('all_orders', $all_orders)
                    ->with('complete_orders', $complete_orders)
                    ->with('active_orders', $active_orders)
                    ->with('pending_orders', $pending_orders)
                    ->with('cancel_orders', $cancel_orders)
                    ->with('reject_orders', $reject_orders);
            }
        );

        //tickets main style
        view()->composer(
            'admins.tickets.main',
            function ($view) {
                $all_tickets = Ticket::all();
                $contact_reasons = ContactReasons::all();
                $new_tickets = [];
                $closed_tickets = [];

                foreach ($contact_reasons as $contact_reason) {
                    $new_tickets[$contact_reason->id] = Ticket::where('status', 'new')->where('contact_reason_id', '=', $contact_reason->id)->count();
                    $closed_tickets[$contact_reason->id] = Ticket::where('status', 'closed')->where('contact_reason_id', '=', $contact_reason->id)->count();
                }

                $view
                    ->with('all_tickets', $all_tickets)
                    ->with('contact_reasons', $contact_reasons)
                    ->with('closed_tickets', $closed_tickets)
                    ->with('new_tickets', $new_tickets);
            }
        );
    }
}
