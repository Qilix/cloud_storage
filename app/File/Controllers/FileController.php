<?php

namespace App\File\Controllers;

use App\Common\Controllers\Controller;
use App\Common\Models\File;
use App\File\Actions\FileData;
use App\File\Factories\FileRenameFactory;
use App\File\Factories\FileUploadFactory;
use App\File\Presenters\FilePresenter;
use App\File\Queries\FileQueries;
use App\File\Requests\FileRenameRequest;
use App\File\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Auth;
use App\File\Services\FileServices;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{

    /**
     *
     * Получение всех файлов авторизованного пользователя
     * и размер всех его файлов на диске.
     *
     * @param FileQueries $queries
     * @param FilePresenter $presenter
     */

    public function index(FileQueries $queries, FilePresenter $presenter)
    {
        $files = $queries->get(Auth::user());
        $data = new FileData();
        $currentSize = $data->getSize($files);
        return response()->json(['files'=>$presenter->collect($files),'size' => $currentSize.'/100Mb']);
    }

    /** Загрузка файлов
     *
     * @param FileUploadRequest $request
     * @param FileQueries $queries
     * @param FileServices $services
     * @param int $folderId
     */

    public function upload(FileUploadRequest $request,FileQueries $queries, FileServices $services, $folderId=null)
    {
        $files = $queries->get(Auth::user());
        $dto = FileUploadFactory::fromRequest($folderId, $request, Auth::user(), $files);
        $model = $services->uploadFile($folderId, $dto, Auth::user());
        return response()->json([
            "message" => "File successfully uploaded",
            "file" => $model
        ]);
    }

    /** Переименование файла
     *
     * @param int $id
     * @param FileRenameRequest $request
     * @param FilePresenter $presenter
     * @param FileServices $services
     * @param FileQueries $queries
     */

    public function rename($id, FileRenameRequest $request, FilePresenter $presenter, FileServices $services, FileQueries $queries)
    {
        $dto = FileRenameFactory::fromRequest($request);
        $model = $services->renameFile($id, $queries, $dto, Auth::user());
        return Response::json($presenter->present($model));
    }

    /** Удаление файла
     *
     * @param int $id
     * @param FileServices $services
     * @param FileQueries $queries
     */

    public function delete($id, FileServices $services, FileQueries $queries)
    {
        $services->deleteFile($id, $queries, Auth::user());
        return Response::json(['message' => 'Successfully deleted']);
    }

    /** Скачивание файла
     *
     * @param int $id
     * @param FileServices $services
     * @param FileQueries $queries
     */

    public function download($id,FileServices $services, FileQueries $queries){
        $file = $services->downloadFile($id, $queries, Auth::user());
        return Storage::download($file);
    }
}
