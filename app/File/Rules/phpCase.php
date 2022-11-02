<?php

namespace App\File\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class phpCase implements InvokableRule
{
    public function __invoke($attribute, $value, $fail)
    {
        if ($value->getClientOriginalExtension() === 'php') {
            $fail('Расширение .php недопустимо');
        }
    }
}
