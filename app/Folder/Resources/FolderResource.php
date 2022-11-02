<?php

namespace App\Folder\Resources;

use Carbon\Carbon;

class FolderResource
{
    public int $id;

    public string $name;

    public string $owner;

    public Carbon $created_at;

    public Carbon $updated_at;

}
