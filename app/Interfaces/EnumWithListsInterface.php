<?php

namespace App\Interfaces;

interface EnumWithListsInterface
{
    public static function listNames() : array;

    public static function listValues() : array;
}
