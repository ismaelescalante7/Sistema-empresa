<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TemporaryPassword
{
    public function __construct(
        private int $passwordLength = 8
    ) {
    }

    public function __invoke(): string
    {
        return Hash::make(
            Str::random($this->passwordLength)
        );
    }
}
