<?php

namespace App\File\Services;

use App\Common\Models\File;
use App\File\Actions\FileData;
use App\User\Queries\UserQueries;
use Illuminate\Support\Facades\Storage;


class FileServices
{
    public function uploadFile($folderId, $dto, $user): File
    {
        $file = new File();
        $file->name = $dto->name;
        $file->size = $dto->size;
        $file->owner = $user->id;
        $file->folder_id = $folderId;

        $file->save();

        return $file;
    }

    public function renameFile($id, $queries, $dto, $user): File
    {
        $data = new FileData();

        $file = $queries->getDetail($id, $user);

        $folderId = $file->folder_id;
        $oldpath = $data->getPath($folderId,$user,$file->name);

        $extension = strstr( $file->name,'.');
        $file->name = $dto->name.$extension;

        $newpath=$data->getPath($folderId,$user,$file->name);
        Storage::move($oldpath,$newpath);

        $file->save();

        return $file;
    }

    public function deletefile($id, $queries, $user)
    {
        $file = $queries->getDetail($id, $user);

        $folderId = $file->folder_id;
        $name = $file->name;

        $data = new FileData();
        $path = $data->getPath($folderId, $user, $name);

        Storage::delete($path);
        $file->delete();
    }

    public function downloadFile($id, $queries, $user){
        $file = $queries->getDetail($id, $user);

        $folderId = $file->folder_id;
        $name = $file->name;

        $data = new FileData();
        $path = $data->getPath($folderId, $user, $name);

        return Storage::download($path);
    }

    public function generate($id, $queries, $dto, $user){

        $file = $queries->getDetail($id, $user);
        $file->public_link = $dto->public_link;
        $file->save();

        return $file;
    }

    public function downloadByLink($link, $queries){
     $file = $queries->getByLink($link);

     $folderId = $file->folder_id;
     $name = $file->name;

     $userData = new UserQueries();
     $user = $userData->get($file->owner);

     $data = new FileData();
     $path = $data->getPath($folderId, $user, $name);

     return Storage::download($path);
    }
}
