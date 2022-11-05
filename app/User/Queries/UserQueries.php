<?php

namespace App\User\Queries;

use App\Common\Models\User;

class UserQueries
{
    public function get($user)
    {
        return User::findOrFail($user);
    }
}
