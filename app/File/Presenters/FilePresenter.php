<?php

namespace App\File\Presenters;

use App\File\Resources\FileResource;
use App\Common\Models\File;
use Illuminate\Database\Eloquent\Collection;

class FilePresenter
{
    public function present(File $file): FileResource
    {
        $resource = new FileResource();

        $resource->id = $file->id;
        $resource->name = $file->name;
        $resource->size = $file->size;
        $resource->owner = $file->user->name;
        $resource->folder_id = $file->folder_id;
        $resource->public_link = $file->public_link;
        $resource->created_at = $file->created_at;
        $resource->updated_at = $file->updated_at;
        return $resource;
    }

    public function collect(Collection $files): array
    {
        return $files->map(function (File $file) {
            return $this->present($file);
        })->toArray();
    }
}
