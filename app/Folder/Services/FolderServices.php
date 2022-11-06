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
        $folder->owner = $user->id;

        $path = storage_path('app/user'.$user->id);
        File::makeDirectory($path.'/'.$folder->name, 0777);
        $folder->save();

        return $folder;
    }
}
