<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function folder()
    {
        return $this->hasOne(Folder::class, 'id', 'folder_id');
    }
}
