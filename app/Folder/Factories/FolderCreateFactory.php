<?php

namespace App\Folder\Factories;

use App\Folder\DTOs\FolderCreateDTO;
use Illuminate\Http\Request;

class FolderCreateFactory
{
    public static function fromRequest(Request $request): FolderCreateDTO
    {
        $dto = new FolderCreateDTO();

        $dto->name = $request->name;

        return $dto;
    }
}
