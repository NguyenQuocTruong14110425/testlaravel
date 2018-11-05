<?php

namespace Box\Entity;

use Box\Entity\NewsCategories\NewsCategoriesEntity;
use Box\Entity\Resources\ResourcesEntity;
use Box\Entity\Validation\NewsCategories\NewsCategoriesUpdateValidator;
use Box\Entity\Validation\NewsCategories\NewsCategoriesCreateValidator;
use Box\Entity\Validation\Resources\ResourcesCreateValidator;
use Box\Entity\Validation\Resources\ResourcesUpdateValidator;
use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register services.
     * @return void
     */
    public function register()
    {
        $this->app->bind('Box\Entity\a\NewsCategories\NewsCategoriesEntity', function($app)
        {
            return new NewsCategoriesEntity (
                $app->make('Box\Entity\Repository\NewsCategories\NewsCategoriesRepository'),
                new NewsCategoriesCreateValidator( $app['validator'] ),
                new NewsCategoriesUpdateValidator( $app['validator'] )
            );
        });

        // resources
        $this->app->bind('Box\Entity\a\Resources\ResourcesEntity', function($app)
        {
            return new ResourcesEntity (
                $app->make('Box\Entity\Repository\Resources\ResourcesRepository'),
                new ResourcesCreateValidator( $app['validator'] ),
                new ResourcesUpdateValidator( $app['validator'] )
            );
        });
    }
}
