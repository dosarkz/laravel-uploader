<?php
namespace Dosarkz\LaravelUploader\Provider;

use Dosarkz\LaravelUploader\ImageUploader;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageServiceProvider;

class LaravelUploaderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/laraveluploader.php' => config_path('laraveluploader.php'),
        ]);


    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Intervention\Image\ImageServiceProvider');
        $this->app->bind('Image', 'Intervention\Image\Facades\Image');


        $this->app->singleton('laraveluploader', function ($app) {
            return new ImageUploader();
        });
    }




}
