<?php

namespace App\Enums;

enum SupportStatus: string
{
    case A = "Open";
    case C = "Close";
    case P = "Pendent";

    public static function fromValue(string $value): string
    {
        foreach (self::cases() as $value) {
            if ($value === $value) {
                return $value->value;
            }
        }

        throw new \ValueError("$value is note valid");
    }
}
