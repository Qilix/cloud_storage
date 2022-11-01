<?php

namespace App\Folder\Services;

use App\Folder\DTOs\FolderCreateDTO;
use App\Common\Models\Folder;
use Illuminate\Support\Facades\File;

class FolderServices
{
    public function createFolder(FolderCreateDTO $dto, $user): Folder
    {
        $folder = new Folder();

        $folder->name = $dto->name;
        $folder->path = $dto->path;
        $folder->owner = $user->id;

        File::makeDirectory($folder->path.'\\'.$folder->name, 0777);

        $folder->save();

        return $folder;
    }
}
