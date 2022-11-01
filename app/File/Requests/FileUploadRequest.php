<?php

namespace App\File\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'file' => 'required|mimes:txt,dll|max:20480',
        ];
    }
}
