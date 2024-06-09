<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\SubmissionSaved' => [
            'App\Listeners\LogSubmissionSaved',
        ],
    ];
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
        //
        //parent::boot();
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::except([
            'submit'
        ]);
    }
}
