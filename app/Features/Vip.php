<?php

namespace App\Features;

use Illuminate\Support\Lottery;

class Vip
{
    public readonly string $name;

    public function __construct()
    {
        $this->name = 'vip';
    }

    public function resolve(mixed $scope): bool
    {
        return false;
    }
}
