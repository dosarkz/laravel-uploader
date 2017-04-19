# laravel-uploader
Laravel 5 file uploader with resizer http://image.intervention.io/

# Install 
```
composer require dosarkz/laravel-uploader
```
## Add to config/app.php

## Provider 
```
Dosarkz\LaravelUploader\Provider\LaravelUploaderServiceProvider::class
```
## Alias

```
'ImageUploader' => Dosarkz\LaravelUploader\Facade\LaravelUploaderFacade::class
  
```
## Sample

```
use Dosarkz\LaravelUploader\ImageUploader;


$uploader = new ImageUploader($request->file('image'), 'images/places/');

```
