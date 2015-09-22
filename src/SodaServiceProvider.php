<?php namespace	Alfredoem\Soda;

/**
 *
 * @author kora jai <kora.jayaram@gmail>
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class SodaServiceProvider extends ServiceProvider{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /*public function boot()
    {
        $this->app->booted(function () {
            $this->defineRoutes();
        });

        $this->defineResources();
    }*/

    public function boot()
    {

        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'soda');
        $this->setupRoutes($this->app->router);


        // this  for conig
        $this->publishes([
            __DIR__.'/config/contact.php' => config_path('contact.php'),
        ]);

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Alfredoem\Soda\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }


    public function register()
    {
        $this->registerContact();
        config([
            'config/contact.php',
        ]);
    }

    private function registerContact()
    {
        $this->app->bind('contact',function($app){
            return new Contact($app);
        });
    }
}