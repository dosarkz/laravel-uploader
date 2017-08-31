<?php
namespace Dosarkz\LaravelUploader;

/**
 * Class BaseUploader
 * @package Dosarkz\LaravelUploader
 */
class BaseUploader
{
    /**
     * @param $uploading_file
     * @param $destination
     * @return FileUploader
     */
    public static function file($uploading_file, $destination = null)
    {
        return new FileUploader($uploading_file, $destination);
    }

    /**
     * @param $uploading_file
     * @param null $destination
     * @param bool $resize
     * @param $imageWidth
     * @param $imageHeight
     * @param $thumbWidth
     * @param $thumbHeight
     * @return ImageUploader
     */
    public static function image($uploading_file, $destination = null, $resize = false, $imageWidth = 800,
                                 $imageHeight = null, $thumbWidth = 200, $thumbHeight = null)
    {
        if ($destination == null)
        {
            $destination = 'uploads/images';
        }

        return new ImageUploader($uploading_file, $destination, $resize, $imageWidth, $imageHeight,
            $thumbWidth, $thumbHeight);
    }
}