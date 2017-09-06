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
## Sample image upload
@destination - the path to the image, 'images/articles', string
@resize - A parameter that determines to use compression or not. In the case of using need to fill one of the parameters the resolution of the image, true or false, boolean
@imageWidth, @imageHeight - the parameters of the image in pixels, 100, numeric
@thumbWidth, @thumbHeight - the parameters of the thumbnail in pixels, 100, numeric
##### Uploader::image(uploaded_file, destination, resize, imageWidth, imageHeight, thumbWidth, thumbHeight)
```
  use Uploader;
  
  $image_uploader  = Uploader::image($request->file('avatar'));
  $image = Image::create([
      'name' => $image_uploader->getFileName(),
      'thumb' => $image_uploader->getThumb(),
      'path' => $image_uploader->getDestination(),
  ]);

```

## Sample file upload
##### Uploader::file(uploaded_file, destination)

```
use Uploader;
  
 $image_uploader  = Uploader::file($request->file('file'));

  $file = File::create([
      'name' => $image_uploader->getFileName(),
      'path' => $image_uploader->getDestination(),
      'user_id' => auth()->user()->id
  ]);
                        
```
