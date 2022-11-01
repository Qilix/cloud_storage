<?php

class FileRenameFactory
{
    public static function fromRequest($id, Request $request, $user): FileEditDTO
    {
        $dto = new FileRenameDTO();
        $dto->name = $file->getClientOriginalName();
        $dto->path = $file->storeAs('user' . $user->id . $folderPath, $dto->name);
        return $dto;
    }
}
