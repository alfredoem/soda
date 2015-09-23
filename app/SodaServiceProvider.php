<?php namespace	Alfredoem\Soda;

/**
 *
 * @author kora jai <kora.jayaram@gmail>
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

use Alfredoem\Soda\Console\Install;

class SodaServiceProvider extends ServiceProvider{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->app->booted(function () {
            $this->defineRoutes();
        });

        $this->defineResources();

    }

    protected function defineRoutes()
    {
        if (! $this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Alfredoem\Soda\Http\Controllers'], function ($router) {
                require __DIR__.'/Http/routes.php';
            });
        }
    }


    protected function defineResources()
    {
        $this->loadViewsFrom(SODA_PATH.'/resources/views', 'soda');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                SODA_PATH.'/resources/views' => base_path('resources/views'),
            ], 'soda-full');

            $this->publishes([
                SODA_PATH.'/resources/views/contact' => base_path('resources/views/contact'),
                SODA_PATH.'/resources/views/contact.blade.php' => base_path('resources/views/contact.blade.php'),
                SODA_PATH.'/resources/views/template' => base_path('resources/views/template'),
                SODA_PATH.'/resources/views/template.blade.php' => base_path('resources/views/template.blade.php'),

            ], 'soda-basics');
        }
    }


    public function register()
    {
        $this->registerContact();
        config([
            'config/contact.php',
        ]);

        if (! defined('SODA_PATH')) {
           define('SODA_PATH', realpath(__DIR__.'/../'));
        }

        if(! class_exists('Soda')) {
            class_alias('Alfredoem\Soda\Soda', 'Soda');
        }

        if($this->app->runningInConsole()) {
            $this->commands([Install::class]);
        }

    }

    private function registerContact()
    {
        $this->app->bind('contact',function($app){
            return new Contact($app);
        });
    }
}
