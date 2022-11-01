<?php

namespace App\File\Factories;

use App\File\DTOs\FileUploadDTO;
use App\Folder\Queries\FolderQueries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadFactory
{
    public static function fromRequest($folderId, Request $request, $user): FileUploadDTO
    {
        $folderPath='';

        if ($folderId) {
            $folder = new FolderQueries();
            $folderPath ='/'.$folder->getFolder($folderId, $user)->name;
        }

        $file = $request->file('file');
        $dto = new FileUploadDTO();
        $dto->name = $file->getClientOriginalName();
        $dto->path = $file->storeAs('user'.$user->id.$folderPath,$dto->name);
        $dto->size = round(Storage::size($dto->path)/pow(1024,2),2  ,PHP_ROUND_HALF_UP);
        return $dto;
    }
}
