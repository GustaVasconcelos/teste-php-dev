<?php

namespace App\Utils;

use Illuminate\Support\Facades\Hash;

class Cryptography
{
    public static function encrypt(string $data): string
    {
        return Hash::make($data);
    }

    public static function compare(string $plainData, string $hashedData): bool
    {
        return Hash::check($plainData, $hashedData);
    }
}
