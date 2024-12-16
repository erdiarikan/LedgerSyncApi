<?php

namespace App\Helpers;

class DTOArrayValidator
{
    public static function validate(array $items, string $dtoClass): bool
    {
        foreach ($items as $item) {
            if (!($item instanceof $dtoClass)) {
                return false;
            }
        }
        return true;
    }
}
