<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductPhotoUploadService
{
    public function __construct(private ParameterBagInterface $params) {}

    public function uploadImage(UploadedFile $file): string
    {
        $original_file_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $new_file_name = $original_file_name.'-'.uniqid().'.'.$file->guessExtension();
        dump($original_file_name, $new_file_name);
        $path_destination = $this->params->get('images_directory'); // set in services.yaml
        dump($path_destination);
        $file->move($path_destination, $new_file_name);

        return $new_file_name;
    }
}
