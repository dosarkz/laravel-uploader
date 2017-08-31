<?php
namespace Dosarkz\LaravelUploader;

use Illuminate\Support\Facades\File;

/**
 * Class FileUploader
 * @package Dosarkz\LaravelUploader
 */
class FileUploader extends Uploader
{
    /**
     * FileUploader constructor.
     * @param $uploaded_file
     * @param null $destination
     */
    public function __construct($uploaded_file, $destination = null)
    {
        $this->setUploadedFile($uploaded_file);
        $this->setDestination($destination);

        if (!is_dir(public_path($this->getDestination())))
        {
            File::makeDirectory(public_path($this->getDestination()), $mode = 0777, true);
        }

        parent::__construct();
    }
}