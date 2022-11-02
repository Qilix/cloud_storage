<?php

namespace App\File\Requests;


use App\File\Rules\phpCase;
use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'string|unique:files|max:255',
            'file' => [
                'required',
                'max:20480',
                new phpCase,
        ],
    ];
    }

}
