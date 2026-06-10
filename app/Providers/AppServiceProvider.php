<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use App\Services\MailConfigService;
use Illuminate\Support\Facades\Blade;
use App\Helpers\PermissionHelper;
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
        Validator::extend('validateUsername', function ($attribute, $value, $parameters, $validator) {
            // Your validation logic here
            // Return true if the validation passes, false otherwise
            return true;
        });
        Blade::if('canmenu', function ($menuKey) {
                    return PermissionHelper::can($menuKey);
                });
        MailConfigService::apply();
    }
}
