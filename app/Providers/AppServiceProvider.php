<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;
use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\SettingsCont;
use App\Models\TermsPrivacy;
use App\Models\FeeRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage as FacadesStorage;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesStorage::extend('sftp', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });

        Paginator::useBootstrap();

        // Sharing settings with all view
        $settings = Settings::where('id', '1')->first();
        $terms =  TermsPrivacy::find(1);
        $moreset =  SettingsCont::find(1);

        View::share('settings', $settings);
        View::share('terms', $terms);
        View::share('moresettings', $moreset);
        View::share('mod', $settings->modules);

        View::composer('layouts.dashboard', function ($view) {
            $pendingFees = 0;
            $hasFeeRequests = false;
            if (Auth::check()) {
                $pendingFees = FeeRequest::where('user_id', Auth::id())
                    ->where('status', 'pending')
                    ->count();
                $hasFeeRequests = FeeRequest::where('user_id', Auth::id())->exists();
            }
            $view->with('pendingFees', $pendingFees);
            $view->with('hasFeeRequests', $hasFeeRequests);
        });
    }
}