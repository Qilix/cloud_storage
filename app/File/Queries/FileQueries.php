<?php

namespace App\File\Queries;

use App\Common\Models\File;

class FileQueries
{
    public function get($user)
    {
        $data = File::where('owner', $user->id)->get();
        return $data;
    }

}
