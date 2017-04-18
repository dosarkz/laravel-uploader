<?php
namespace Dosarkz\LaravelUploader;

use Illuminate\Support\Facades\File;

class ImageUploader extends Uploader
{
    public function __construct($image = null)
    {
        $this->image = $image;
        $this->destination = 'uploads/images/';
        $this->thumbWidth = 100;

        if (!is_dir(public_path($this->destination)))
        {
            File::makeDirectory(public_path($this->destination), $mode = 0777, true);
        }

        parent::__construct();
    }
}