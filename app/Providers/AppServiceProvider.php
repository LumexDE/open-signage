<?php

namespace App\Providers;

use App\Models\Room;
use App\Models\Screen;
use App\Models\RoomScreen;
use App\Models\Announcement;
use App\Models\PlaylistItem;
use App\Models\ScheduleEntry;
use App\Channels\AdminChannel;
use App\Observers\RoomObserver;
use App\Observers\ScreenObserver;
use App\Observers\ScheduleObserver;
use Illuminate\Support\Facades\URL;
use App\Observers\RoomScreenObserver;
use Illuminate\Support\Facades\Event;
use App\Observers\AnnouncementObserver;
use App\Observers\PlaylistItemObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->app->register(\Sentry\Laravel\Integration::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Screen::observe(ScreenObserver::class);
        PlaylistItem::observe(PlaylistItemObserver::class);
        Announcement::observe(AnnouncementObserver::class);
        ScheduleEntry::observe(ScheduleObserver::class);
        RoomScreen::observe(RoomScreenObserver::class);

        Notification::extend('admin', function ($app) {
            return new AdminChannel();
        });

        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('authentik', \SocialiteProviders\Authentik\Provider::class);
        });

        if (app()->environment('production') || app()->environment('testing')) {
            URL::forceScheme('https');
        }
    }
}
