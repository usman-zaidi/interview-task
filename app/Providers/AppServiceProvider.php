<?php

namespace App\Providers;

use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\ProductRepositoryInterface;
use App\Services\CSVImportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('csv-import', function () {
            return new CSVImportService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
