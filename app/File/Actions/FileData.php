<?php

namespace App\File\Actions;

use App\File\Exceptions\MaxSizeException;
use App\Folder\Queries\FolderQueries;
use http\Env\Request;

class FileData
{

    public function getName($request)
    {
        return $request->file('file')->getClientOriginalName();
    }

    /** Получение размера файлов
     *
     *  @param array $files
     */

    public function getSize($files){
        $size = 0;
        foreach($files as $file) {
            $size += $file->size;
        }
        return $size;
    }

    /** Задает путь для загрузки файла
     *
     *  @param int $folderId
     *  @param User $user
     *  @param string $name
     *  @param Request $request
     *  @param array $files
     */

    public function setPath($folderId, $user, $name, $request, $files){
        $file = $request->file('file');
        $folderPath='';

        $size = round($file->getSize()/pow(1024,2),3,PHP_ROUND_HALF_UP);;
        $sizeDisk = $this->getSize($files);

        /** Ошибка в случае превышение максимального размера диска */
        if($size + $sizeDisk > 100){
            throw new MaxSizeException('Максимальный размер 100Mb');
        }

        if ($folderId) {
            $folder = new FolderQueries();
            $folderPath ='/'.($folder->getFolder($folderId, $user)->name);
        }

        return $file->storeAs('user'.$user->id.$folderPath, $name);
    }

    public function getPath($folderId, $user, $name){
        $folderPath='';
        if ($folderId) {

            $folder = new FolderQueries();
            $folderPath ='/'.($folder->getFolder($folderId, $user)->name);
        }

        $path = 'user'.$user->id.$folderPath.'/'.$name;
        return $path;
    }


}
