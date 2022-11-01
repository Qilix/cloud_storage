<?php

namespace App\Common\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function files()
    {
        return $this->hasMany(File::class,  'folder_id');
    }
}
