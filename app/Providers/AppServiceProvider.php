<?php

namespace App\Providers;

use App\Http\Interfaces\MailInterface;
use App\Http\Repositories\MailRepositories;
use Illuminate\Database\Eloquent\Builder;
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

    public function boot()
    {
        Builder::macro('whereLike', function(string $column, string $search) {
            return $this->orWhere($column, 'LIKE', '%'.$search.'%');
        });
    }
}
