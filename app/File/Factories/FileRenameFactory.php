<?php

namespace App\File\Factories;

use App\File\Actions\FileData;
use App\File\DTOs\FileRenameDTO;

class FileRenameFactory
{
    public static function fromRequest($request): FileRenameDTO
    {

        $dto = new FileRenameDTO();
        $dto->name = $request->get('name');

        return $dto;
    }
}
