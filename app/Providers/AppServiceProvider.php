<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            $siteSettings = [];
            $unreadMessagesCount = 0;

            try {
                if (Schema::hasTable('settings')) {
                    $siteSettings = Setting::getAll();
                }
                if (Schema::hasTable('contact_messages')) {
                    $unreadMessagesCount = ContactMessage::unread()->count();
                }
            } catch (\Exception $e) {
                // Fail-safe during installations or tests
            }

            $view->with('siteSettings', $siteSettings);
            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });
    }
}
