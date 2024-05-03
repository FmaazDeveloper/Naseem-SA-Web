<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdministrativeRegionController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandmarkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RequestOrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

//contents
Route::get('/{administrative_region_id?}', [ContentController::class, 'index'])->name('contents.index');
Route::get('/home/regions/{administrative_region_id?}', [ContentController::class, 'regions'])->name('contents.regions');
Route::get('/home/landmarks/{region_id?}', [ContentController::class, 'landmarks'])->name('contents.landmarks');

//user routes
Route::group(
    [
        'prefix' => 'user',
        'middleware' => 'auth',
    ],
    function () {
        //profile routes
        Route::get('/profile/{user_id}', [ProfileController::class, 'index'])->name('profiles.index');
        // Route::get('/profile/create/{user_id}', [ProfileController::class, 'create'])->name('profiles.create');
        // Route::post('/profile', [ProfileController::class, 'store'])->name('profiles.store');
        Route::get('/profiles/{user_id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::put('/profiles/{user_id}', [ProfileController::class, 'update'])->name('profiles.update');

        //ticket routes
        Route::get('/tickets/create/', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

        //order routes
        Route::get('/orders/tourist', [RequestOrderController::class, 'show'])->name('request_orders.show')->middleware('role:guide');
        Route::get('/orders/{region_id?}', [RequestOrderController::class, 'index'])->name('request_orders.index')->middleware('role:tourist');
        Route::get('/orders/guide/{user_id}', [RequestOrderController::class, 'create'])->name('request_orders.create')->middleware('role:tourist');
        Route::post('/orders/{profile_id}', [RequestOrderController::class, 'store'])->name('request_orders.store')->middleware('role:tourist');
        // Route::get('/orders/{order_id}/edit', [RequestOrderController::class, 'edit'])->name('request_orders.edit')->middleware('role:tourist');
        Route::put('/orders/{order_id}', [RequestOrderController::class, 'update'])->name('request_orders.update');
    }
);
//admin routes
Route::group(
    [
        'prefix' => 'admin/',
        'middleware' => ['role:manager|super-admin|admin'],
    ],
    function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboards.index');

        Route::group([
            'middleware' => ['role:manager|super-admin'],
        ], function () {
            //start users routes
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
            //end users routes

            //start roles routes
            Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
            Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
            Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

            Route::get('roles/{role}/edit-permissions', [RoleController::class, 'editPermissionToRole'])->name('roles.editPermissionToRole');
            Route::put('roles/{role}/edit-permissions', [RoleController::class, 'updatePermissionToRole'])->name('roles.updatePermissionToRole');
            //end roles routes

            //start permissions routes
            Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
            Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
            Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
            Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
            //end permissions routes
        });

        //start administrative_region routes
        Route::get('/administrative_regions', [AdministrativeRegionController::class, 'index'])->name('administrative_regions.index');
        // Route::get('/administrative_regions/create', [AdministrativeRegionController::class, 'create'])->name('administrative_regions.create');
        // Route::post('/administrative_regions', [AdministrativeRegionController::class, 'store'])->name('administrative_regions.store');
        Route::get('/administrative_regions/{administrative_region}/edit', [AdministrativeRegionController::class, 'edit'])->name('administrative_regions.edit');
        Route::put('/administrative_regions/{administrative_region}', [AdministrativeRegionController::class, 'update'])->name('administrative_regions.update');
        // Route::delete('/administrative_regions/{administrative_region}', [AdministrativeRegionController::class, 'destroy'])->name('administrative_regions.destroy');
        //end administrative_region routes

        //start regions routes
        Route::get('/regions/{administrative_region?}', [RegionController::class, 'index'])->name('regions.index');
        Route::get('/regions/create/{administrative_region_id}', [RegionController::class, 'create'])->name('regions.create');
        Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
        Route::get('/regions/{region}/edit', [RegionController::class, 'edit'])->name('regions.edit');
        Route::put('/regions/{region}', [RegionController::class, 'update'])->name('regions.update');
        Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');
        //end regions routes

        //start landmarks routes
        Route::get('/landmarks/{region}', [LandmarkController::class, 'index'])->name('landmarks.index');
        Route::get('/landmarks/create/{administrative_region_id}', [LandmarkController::class, 'create'])->name('landmarks.create');
        Route::post('/landmarks', [LandmarkController::class, 'store'])->name('landmarks.store');
        Route::get('/landmarks/{landmark}/edit', [LandmarkController::class, 'edit'])->name('landmarks.edit');
        Route::put('/landmarks/{landmark}', [LandmarkController::class, 'update'])->name('landmarks.update');
        Route::delete('/landmarks/{landmark}', [LandmarkController::class, 'destroy'])->name('landmarks.destroy');
        //end landmarks routes

        //start activities routes
        Route::get('/activities/{landmark}', [ActivityController::class, 'index'])->name('activities.index');
        Route::get('/activities/create/{landmark_id}', [ActivityController::class, 'create'])->name('activities.create');
        Route::post('/activities', [ActivityController::class, 'store'])->name('activities.store');
        Route::get('/activities/{activity}/edit', [ActivityController::class, 'edit'])->name('activities.edit');
        Route::put('/activities/{activity}', [ActivityController::class, 'update'])->name('activities.update');
        Route::delete('/activities/{activity}', [ActivityController::class, 'destroy'])->name('activities.destroy');
        //end activities routes

        //start tickets routes
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
        Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');
        //end tickets routes

        //start orders routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        //end orders routes

    }
);
