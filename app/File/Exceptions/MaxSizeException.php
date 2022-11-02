<?php

namespace App\File\Exceptions;

use Exception;

class MaxSizeException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
