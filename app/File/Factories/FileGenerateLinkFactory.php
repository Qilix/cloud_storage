<?php

namespace App\File\Factories;

use App\File\DTOs\FileGenerateLinkDTO;
use Illuminate\Support\Str;

class FileGenerateLinkFactory
{
    public static function fromRequest(): FileGenerateLinkDTO
    {

        $dto = new FileGenerateLinkDTO();
        $dto->public_link = Str::uuid();;

        return $dto;
    }
}
