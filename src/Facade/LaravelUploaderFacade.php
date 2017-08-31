<?php
namespace Dosarkz\LaravelUploader\Facade;

use Illuminate\Support\Facades\Facade;

class LaravelUploaderFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uploader';
    }
}