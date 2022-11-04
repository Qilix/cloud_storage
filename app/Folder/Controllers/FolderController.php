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

    /** Получение всех папок пользователя
     *
     * @param FolderQueries $queries
     * @param FolderPresenter $presenter
     */
    public function get(FolderQueries $queries, FolderPresenter $presenter)
    {
        $data = $queries->get(Auth::user());
        return Response::json(['folders'=>$presenter->collect($data)]);
    }

    /** Получение данных о папке
     * и размер файлов в ней
     *
     * @param int $id
     * @param FolderQueries $folderqueries
     * @param FileQueries $filequeries
     * @param FolderPresenter $presenter
     */

    public function getDetail($id,FolderQueries $folderqueries, FileQueries $filequeries, FolderPresenter $presenter){
        $data = $folderqueries->getFolder($id,Auth::user());
        $files = $filequeries->getInFolder($id);
        $sizeData = new FileData();
        $currentSize = $sizeData->getSize($files);
        return Response::json(['folder'=>$presenter->present($data), 'folderSize'=>$currentSize.'Mb']);
    }

    /** Создание папки
     *
     *  @param FolderCreateRequest $request
     *  @param FolderPresenter $presenter
     *  @param FolderServices $service
     */
    public function create(FolderCreateRequest $request, FolderPresenter $presenter, FolderServices $service)
    {
        $dto = FolderCreateFactory::fromRequest($request);
        $model = $service->createFolder($dto, Auth::user());
        return Response::json($presenter->present($model));
    }
}
