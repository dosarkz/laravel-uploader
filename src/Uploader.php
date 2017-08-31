<?php
namespace Dosarkz\LaravelUploader;

use UploadedFile;

abstract class Uploader
{
    /**
     * @var
     */
    protected $fileName;
    /**
     * @var
     */
    public $destination;
    /**
     * @var
     */
    public $uploaded_file;

    /**
     * Uploader constructor.
     */
    public function __construct()
    {
        $this->setFileName($this->generateFileName());
        $this->upload($this->getUploadedFile());
    }

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
     * @return mixed
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * @param mixed $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }

    /**
     * @return mixed
     */
    public function getUploadedFile()
    {
        return $this->uploaded_file;
    }

    /**
     * @param mixed $uploaded_file
     */
    public function setUploadedFile($uploaded_file)
    {
        $this->uploaded_file = $uploaded_file;
    }

    /**
     * @return string
     */
    public function generateFileName()
    {
        return time() . '_' . rand(0,100) . '.' . $this->uploaded_file->getClientOriginalExtension();
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return mixed
     */
    public function upload(UploadedFile $uploadedFile)
    {
        return $uploadedFile->move(public_path($this->getDestination()),  $this->getFileName());
    }
}