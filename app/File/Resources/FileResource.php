<?php

namespace App\File\Resources;

use Carbon\Carbon;

class FileResource
{
    public int $id;

    public string $name;

    public string $path;

    public string $owner;

    public int $size;

    public Carbon $created_at;

    public Carbon $updated_at;

}
