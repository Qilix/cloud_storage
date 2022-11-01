<?php

namespace App\Folder\Queries;

use App\Common\Models\Folder;

class FolderQueries
{
    public function get($user)
    {
        $data = Folder::where('owner', $user->id)->get();
        return $data;
    }

    public function getFolder($id, $user)
    {
        $data = Folder::where('owner', $user->id)->findOrFail($id);
        return $data;
    }
}
