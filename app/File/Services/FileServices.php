<?php

namespace App\File\Services;

use App\File\DTOs\FileEditDTO;
use App\Common\Models\File;

class FileServices
{
    public function uploadFile($folderId, FileEditDTO $dto, $user): File
    {
        $file = new File();
        $file->name = $dto->name;
        $file->path = $dto->path;
        $file->size = $dto->size;
        $file->owner = $user->id;
        $file->folder_id = $folderId;

        $file->save();

        return $file;
    }

//    public function uploadFile(FileEditDTO $dto, $user): File
//    {
//        $file = new File();
//        $file->name = $dto->name;
//        $file->path = $dto->path;
//        $file->size = $dto->size;
//        $file->owner = $user->id;
//
//        $file->save();
//
//        return $file;
//    }

//    public function updatefile($id, fileQueries $quaries, fileUpdateDTO $dto, $user): file
//    {
//        $file = $quaries->getAuthorDetail($id, $user);
//
//        $file->title = $dto->title;
//        $file->description = $dto->description;
//        $file->text = $dto->text;
//
//        $file->sub_only = $dto->sub_only;
//
//        $file->save();
//
//        return $file;
//    }
//
//    public function deletefile($id, fileQueries $queries, User $user)
//    {
//        $file = $queries->getAuthorDetail($id, $user);
//        $file->delete();
//    }
}
