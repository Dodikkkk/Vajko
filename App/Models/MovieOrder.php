<?php

namespace App\Models;

enum MovieOrder: int
{
    case ALPHABETICALLY = 1;
    case RATING_BEST = 2;
    case RATING_WORST = 3;
    case NEWEST = 4;
    case OLDEST = 5;

    function getOrder(): string
    {
        return match ($this) {
            self::ALPHABETICALLY => "lower(title)",
            self::RATING_BEST => "rating desc",
            self::RATING_WORST => "rating asc",
            self::NEWEST => "release_date desc",
            self::OLDEST => "release_date asc"
        };
    }
}