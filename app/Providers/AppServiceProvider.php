<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use App\Models\ItemUnitModel;
use App\Models\ItemModel;
use App\Models\InvoiceModel;
use App\Observers\ItemUnitObserver;
use App\Observers\ItemConsumableObserver;
use App\Observers\InvoiceObserver;


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
    ItemUnitModel::observe(ItemUnitObserver::class);
    ItemModel::observe(ItemConsumableObserver::class);
    InvoiceModel::observe(InvoiceObserver::class);
    Carbon::setLocale('id');
    }

}
