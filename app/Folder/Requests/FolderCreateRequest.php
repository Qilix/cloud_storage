<?php

namespace App\Folder\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['name' => 'required|string'];
    }
}
