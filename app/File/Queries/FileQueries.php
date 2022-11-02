<?php

namespace App\File\Queries;

use App\Common\Models\File;

class FileQueries
{
    public function get($user)
    {
        return File::where('owner', $user->id)->get();
    }

    public function getDetail($id, $user)
    {
        return File::where('owner', $user->id)->findOrFail($id);
    }

    public function getInFolder($folder_id)
    {
        return File::where('folder_id', $folder_id)->get();
    }
}
