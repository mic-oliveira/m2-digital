<?php

namespace App\Traits;

trait EnumListsTrait
{
    public static function listNames(): array
    {
        return array_map(static fn ($enum) => $enum->name, self::cases());
    }

    public static function listValues(): array
    {
        return array_map(static fn ($enum) => $enum->value ?? $enum->name, self::cases());
    }
}
