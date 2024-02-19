<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('open', function ($expression) {
            return "<?php echo request()->is($expression) ? 'open' : '' ?>";
        });

        Blade::directive('active', function ($expression) {
            return "<?php echo request()->is($expression) ? 'active' : '' ?>";
        });
    }
}
