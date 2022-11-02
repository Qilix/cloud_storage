<?php

namespace App\Folder\Presenters;

use App\Folder\Resources\FolderResource;
use App\Common\Models\Folder;
use App\File\Presenters\FilePresenter;


class FolderPresenter
{
    public function __construct(protected FilePresenter $filePresenter)
    {
    }

    public function present(Folder $folder): FolderResource
    {
        $resource = new FolderResource();

        $resource->id = $folder->id;
        $resource->name = $folder->name;
        $resource->owner = $folder->user->name;
        $resource->created_at = $folder->created_at;
        $resource->updated_at = $folder->updated_at;
        $resource->files = $this->filePresenter->collect($folder->files);
        return $resource;
    }

    public function collect($folders): array
    {
        return $folders->map(function (Folder $folder) {
            return $this->present($folder);
        })->toArray();
    }
}
