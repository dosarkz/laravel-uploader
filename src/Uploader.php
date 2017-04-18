<?php
namespace Dosarkz\LaravelUploader;

use Intervention\Image\Facades\Image;

abstract class Uploader
{
    public function __construct()
    {
        $this->setFileName($this->generateFileName());
        $this->setThumb($this->generateThumb());
        $this->upload();
    }

    /**
     * @var
     */
    protected $fileName;
    /**
     * @var
     */
    protected $thumb;
    /**
     * @var
     */
    protected $image;
    /**
     * @var
     */
    public $destination;
    /**
     * @var
     */
    public $model;
    /**
     * @var int
     */
    public $imageHeight = null;
    /**
     * @var int
     */
    public $imageWidth = 1024;
    /**
     * @var int
     */
    public $thumbHeight = null;
    /**
     * @var int
     */
    public $thumbWidth = 385;

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function generateFileName()
    {
        return time() . '_' . rand(0,100) . '.' . $this->image->getClientOriginalExtension();
    }

    /**
     * @return string
     */
    public function generateThumb()
    {
        return 'thumb_' . $this->getFileName();
    }

    public function upload()
    {
        if ($this->image->getClientOriginalExtension() == 'gif')
        {
            $this->uploadFile($this->getFileName());
        }else{
            $this->uploadImageFile($this->getFileName());
            $this->uploadImageThumb($this->getThumb());
        }
    }

    public function uploadFile($filename)
    {
        return $this->image->move(public_path($this->destination),  $filename);
    }

    /**
     * @param $filename
     * @param $resize
     * @return mixed
     */
    public function uploadImageFile($filename, $resize = true)
    {
        if ($resize)
        {
            list($width, $height) = getimagesize($this->image->getRealPath());

            if ($width > $this->imageWidth)
            {
                return Image::make($this->image->getRealPath())
                    ->resize($this->imageWidth, $this->imageHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path($this->destination . $filename));
            }else {
                return Image::make($this->image->getRealPath())
                    ->save(public_path($this->destination . $filename));
            }
        }else{
            return Image::make($this->image->getRealPath())
                ->save(public_path($this->destination . $filename));
        }

    }

    /**
     * @param $thumb
     * @return mixed
     */
    public function uploadImageThumb($thumb)
    {
        list($width, $height) = getimagesize($this->image->getRealPath());

        if ($width > $this->thumbWidth)
        {
            Image::make($this->image->getRealPath())->resize($this->thumbWidth, $this->thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save(public_path($this->destination . $thumb));
        }else{
            return Image::make($this->image->getRealPath())
                ->save(public_path($this->destination . $thumb));
        }


        return $thumb;
    }

}
