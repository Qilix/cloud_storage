<?php

namespace App\Folder\Controllers;

use App\Common\Controllers\Controller;
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
        $files= $queries->get(Auth::user());
        return Response::json(['folders'=>$presenter->collect($files)]);
    }

    public function create(FolderCreateRequest $request, FolderPresenter $presenter, FolderServices $service)
    {
        $dto = FolderCreateFactory::fromRequest($request, Auth::user());
        $model = $service->createFolder($dto, Auth::user());
        return Response::json($presenter->present($model));
    }
}