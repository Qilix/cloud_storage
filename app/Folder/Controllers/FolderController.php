<?php

namespace App\Folder\Controllers;

use App\Common\Controllers\Controller;
use App\File\Actions\FileData;
use App\File\Queries\FileQueries;
use App\Folder\Factories\FolderCreateFactory;
use App\Folder\Presenters\FolderPresenter;
use App\Folder\Queries\FolderQueries;
use App\Folder\Requests\FolderCreateRequest;
use App\Folder\Services\FolderServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class FolderController extends Controller
{
    public function get(FolderQueries $queries, FolderPresenter $presenter)
    {
        $data = $queries->get(Auth::user());
        return Response::json(['folders'=>$presenter->collect($data)]);
    }

    public function getDetail($id,FolderQueries $folderqueries, FileQueries $filequeries, FolderPresenter $presenter){
        $data = $folderqueries->getFolder($id,Auth::user());
        $files = $filequeries->getInFolder($id);
        $sizeData = new FileData();
        $currentSize = $sizeData->getSize($files);
        return Response::json(['folder'=>$presenter->present($data), 'folderSize'=>$currentSize.'Mb']);
    }
    public function create(FolderCreateRequest $request, FolderPresenter $presenter, FolderServices $service)
    {
        $dto = FolderCreateFactory::fromRequest($request, Auth::user());
        $model = $service->createFolder($dto, Auth::user());
        return Response::json($presenter->present($model));
    }
}
