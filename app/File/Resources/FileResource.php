<?php

namespace App\File\Resources;

use Carbon\Carbon;

class FileResource
{
    public int $id;

    public string $name;

    public string $owner;

    public float $size;

    public ?int $folder_id;

    public Carbon $created_at;

    public Carbon $updated_at;

}
