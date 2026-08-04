<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\URL;
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('admin.layout', function ($view) {
            $view->with('unreadMessagesCount', ContactMessage::where('is_read', false)->count());
            $view->with('pendingLayananCount', ServiceRequest::where('status', 'diajukan')->count());
        });
    }
}
