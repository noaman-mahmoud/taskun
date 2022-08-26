<?php

namespace App\Providers;

use App\Models\User;

use App\Models\Image;
use App\Models\Intro;
use App\Models\Social;
use App\Models\Category;
use App\Models\IntroSlider;
use App\Models\IntroHowWork;
use App\Observers\UserObserver;
use App\Observers\ImageObserver;
use App\Observers\IntroObserver;
use App\Observers\SocialObserver;
use App\Observers\CategoryObserver;
use App\Observers\IntroSliderObserver;
use App\Observers\IntroHowWorkObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User           ::observe(UserObserver::class);
        Social         ::observe(SocialObserver::class);
        Intro          ::observe(IntroObserver::class);
        IntroHowWork   ::observe(IntroHowWorkObserver::class);
        IntroSlider    ::observe(IntroSliderObserver::class);
        Image          ::observe(ImageObserver::class);
        Category       ::observe(CategoryObserver::class);

        view()->composer('*', function ($view)
         {

         });

        // -------------- lang ---------------- \\
            app()->singleton('lang', function (){
                return session()->has( 'lang') ? session( 'lang' ) : 'ar';
            });
        // -------------- lang ---------------- \\
    }
}
