<?php

namespace App\Utils\Uploader;



use Psr\Container\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function upload(UploadedFile $uploadedFile)
    {
        if ($uploadedFile instanceof UploadedFile) {
            $fileName = $this->generateUniqueName() . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move(
                $this->getTargetDirectory(),
                $fileName
            );
            return $fileName;
        }
    }

    public function removeFile($fileName)
    {
        if (is_null($fileName)) {
            return;
        }
        $filesyteme = new Filesystem();
        $path = $this->getTargetDirectory() . '/' . $fileName;
        $filesyteme->remove(
            $path
        );
    }

    private function generateUniqueName()
    {
        return md5(uniqid());
    }


    public function getTargetDirectory()
    {
        return $this->container->getParameter('uploader_directory');
    }
}
