<?php

namespace App\File\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRenameRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'string|unique:files|max:255',
        ];
    }
}
