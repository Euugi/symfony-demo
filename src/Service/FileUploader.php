<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function upload(UploadedFile $file): ?string
    {
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->guessExtension();
        $newFileName = $filename.'.'.$extension;
        if (!file_exists($newFileName)) {
            $file->move(strval($this->parameterBag->get('app.images_directory')), $newFileName);
        }

        return $newFileName;
    }
}
