<?php
namespace Dosarkz\LaravelUploader;

use Illuminate\Support\Facades\File;

class ImageUploader extends Uploader
{
    public function __construct($image = null, $destination = null)
    {
        $this->image = $image;

        if ($destination == null)
        {
            $this->destination = 'uploads/images/';
        }else{
            $this->destination = $destination;
        }

        $this->thumbWidth = 150;

        if (!is_dir(public_path($this->destination)))
        {
            File::makeDirectory(public_path($this->destination), $mode = 0777, true);
        }

        parent::__construct();
    }
}