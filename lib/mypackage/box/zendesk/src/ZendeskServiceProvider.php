<?php

namespace Box\Zendesk;

use Illuminate\Support\ServiceProvider;

class ZendeskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        if (is_dir(base_path().'/resources/views/box/Zendesk')) {
            $this->loadViewsFrom(base_path().'/resources/views/box/Zendesk', 'Zendesk');
        } else {
            $this->loadViewsFrom(__DIR__.'/Views', 'Zendesk');
        }
        $this->publishes([
            __DIR__.'/Views' => base_path('/resources/views/box/Zendesk'),
        ]);
    }
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        include __DIR__.'/Router/routes.php';
        $this->app->singleton(HttpClient::class, function () {
            return new HttpClient();
        });
        $this->app->alias(HttpClient::class, 'HttpClient');
    }
}
