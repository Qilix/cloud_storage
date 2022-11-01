<?php

namespace App\File\Controllers;

use App\Common\Controllers\Controller;
use App\File\Factories\FileUploadFactory;
use App\File\Presenters\FilePresenter;
use App\File\Queries\FileQueries;
use App\File\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Auth;
use App\File\Services\FileServices;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function index(FileQueries $queries, FilePresenter $presenter)
    {
        $files = $queries->get(Auth::user());
        return response()->json(['files'=>$presenter->collect($files)]);
    }

    public function upload(FileUploadRequest $request, FileServices $services, $folderId=null)
    {
        $dto = FileUploadFactory::fromRequest($folderId, $request, Auth::user());
        $model = $services->uploadFile($folderId, $dto, Auth::user());
        return response()->json([
            "message" => "File successfully uploaded",
            "file" => $model
        ]);
    }


}
