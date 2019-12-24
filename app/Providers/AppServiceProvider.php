<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Request;

use App\Models\Language;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        // Get Langs from DB
        $languages = Language::active()->get();

        // Get locale code and Convert them Array
        $localesLangs = $languages->pluck('locale')->toArray();

        // Get First Lang
        $defaultFromDB = $localesLangs[0];
        
        // Get Locale from URL
        $defaultFromUrl = request()->segment(1);

        // check if App locale Exist in DB
        if (in_array($defaultFromUrl, $localesLangs)) {
            app()->setlocale($defaultFromUrl);

        } else {

            app()->setlocale($defaultFromDB);
        }
        
        // For DB String Limit
        Schema::defaultstringlength(191);

        // Get Segemnt (3) for used it in Admin Panel
        $segment = Request::segment(3);

        // Get Locale Now
        $localeLang = app()->getLocale();

        $localeLangInverse = app()->getLocale() == 'ar' ? 'en' : 'ar'; 
        
        $currentLangDir = $languages->firstWhere('locale', $localeLang)->dir;
        
        $hourPrice = Setting::where('settings_key', 'hour_price')->value('settings_value');
        
        view()->share(compact('languages', 'segment', 'currentLangDir', 'localeLang', 'localeLangInverse', 'hourPrice'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Ignore Passport Migration
        Passport::ignoreMigrations();
    }
}
