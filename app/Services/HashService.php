<?php

declare(strict_types=1);

namespace App\Services;

use Hashids\Hashids;

class HashService
{
    private const AVALIABLE_SYMBOLS = 'abcdefghijklmnopqrstuvwxyz';

    public static function encode(int $number): string
    {
        $salt = config('app.key');
        $hashids = new Hashids($salt, 0, self::AVALIABLE_SYMBOLS);
        return $hashids->encode($number);
    }

    public static function decode(string $hash): int
    {
        $hashids = new Hashids('', 0, self::AVALIABLE_SYMBOLS);
        [$result] = $hashids->decode($hash);
        return $result;
    }

}
