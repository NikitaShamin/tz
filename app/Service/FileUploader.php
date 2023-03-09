<?php

namespace App\Service;

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDirectory;

    public function __construct()
    {
        $this->targetDirectory = env('FILES_URL_ON_SERVER');
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $originalFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try
        {
            $file->move($this->getTargetDirectory(), $fileName);
        }
        catch (FileException $exception)
        {
            throw new \RuntimeException($exception->getMessage());
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
