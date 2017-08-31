# laravel-uploader
Laravel 5 image and file uploader with resizer http://image.intervention.io/

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
'Uploader' => Dosarkz\LaravelUploader\Facade\LaravelUploaderFacade::class
  
```
## Sample uploading image

```
  use Uploader;
  
  $image_uploader  = Uploader::image($request->file('avatar'));
  $image = Image::create([
      'name' => $image_uploader->getFileName(),
      'thumb' => $image_uploader->getThumb(),
      'path' => $image_uploader->getDestination(),
  ]);

```
