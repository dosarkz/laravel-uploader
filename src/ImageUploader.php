<?php
namespace Dosarkz\LaravelUploader;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;

/**
 * Class ImageUploader
 * @package Dosarkz\LaravelUploader
 */
class ImageUploader extends Uploader
{
    /**
     * @var bool
     */
    protected $resize;
    /**
     * @var
     */
    protected $imageWidth;
    /**
     * @var
     */
    protected $imageHeight;
    /**
     * @var
     */
    protected $thumbWidth;
    /**
     * @var
     */
    protected $thumbHeight;
    /**
     * @var
     */
    protected $thumb;


    public function __construct($uploaded_file, $destination = null, $resize = false, $imageWidth = 800,
                                $imageHeight = null, $thumbWidth = 200, $thumbHeight = null)
    {
        $this->setUploadedFile($uploaded_file);
        $this->setDestination($destination);


        $this->resize = $resize;
        $this->imageWidth = $imageWidth;
        $this->imageHeight = $imageHeight;
        $this->thumbWidth  = $thumbWidth;
        $this->thumbHeight = $thumbHeight;

        if (!is_dir(public_path($this->destination)))
        {
            File::makeDirectory(public_path($this->destination), $mode = 0777, true);
        }
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param mixed $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     *
     */
    public function upload(UploadedFile $uploadedFile)
    {
        $this->setThumb('thumb_'.$this->getFileName());
        $this->uploadImageFile($this->getFileName());
        $this->uploadImageThumb($this->getThumb());
    }


    /**
     * @param $filename
     * @return mixed
     */
    public function uploadImageFile($filename)
    {
        list($width, $height) = getimagesize($this->getUploadedFile()->getRealPath());

        $img = Image::make($this->getUploadedFile()->getRealPath());
        $img->orientate();

        if ($width > $this->imageWidth)
        {
            return $img->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($this->getDestination() .'/'. $filename));
        }else {
            return $img->save(public_path($this->getDestination()  .'/'. $filename));
        }
    }
    /**
     * @param $thumb
     * @return mixed
     */
    public function uploadImageThumb($thumb)
    {
        list($width, $height) = getimagesize($this->getUploadedFile()->getRealPath());

        $img = Image::make($this->getUploadedFile()->getRealPath());
        $img->orientate();

        if ($width > $this->thumbWidth)
        {
            return  $img->resize($this->thumbWidth, $this->thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(public_path($this->getDestination() .'/'. $thumb));
        }else{
            return $img->save(public_path($this->getDestination() .'/'. $thumb));
        }
    }

}