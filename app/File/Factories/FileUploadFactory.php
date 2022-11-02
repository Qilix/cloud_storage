<?php

namespace App\File\Factories;

use App\File\Actions\FileData;
use App\File\DTOs\FileUploadDTO;
use Illuminate\Support\Facades\Storage;

class FileUploadFactory
{
    public static function fromRequest($folderId, $request, $user, $files): FileUploadDTO
    {

        $data = new FileData();
        $name = $data->getName($request);
        $path = $data->setPath($folderId,$user,$name,$request, $files);

        $dto = new FileUploadDTO();
        $dto->name = $name;
        $dto->size =  round(Storage::size($path)/pow(1024,2),3,PHP_ROUND_HALF_UP);
        return $dto;
    }
}
