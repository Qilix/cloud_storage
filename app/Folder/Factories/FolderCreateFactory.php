<?php

namespace App\Folder\Factories;

use App\Folder\DTOs\FolderCreateDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderCreateFactory
{
    public static function fromRequest(Request $request, $user): FolderCreateDTO
    {
        $dto = new FolderCreateDTO();

        $dto->name = $request->name;
        $dto->path = storage_path('app\user'.$user->id);

        return $dto;
    }
}
