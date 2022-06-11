<?php

namespace App\Providers;

use App\Http\Interfaces\MailInterface;
use App\Http\Repositories\MailRepositories;
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
        $this->app->bind(MailInterface::class,MailRepositories::class);
    }
}
