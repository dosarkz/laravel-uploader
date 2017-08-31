<?php
namespace Dosarkz\LaravelUploader\Provider;

use Dosarkz\LaravelUploader\BaseUploader;
use Illuminate\Support\ServiceProvider;

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
            __DIR__ . '/config/laravel-uploader.php' => config_path('laravel-uploader.php'),
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


        $this->app->singleton('uploader', function ($app) {
            return new BaseUploader();
        });
    }




}
