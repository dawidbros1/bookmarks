<?php

declare (strict_types = 1);

namespace App\Helper;

class Checkbox
{
    public static function get($checkbox)
    {
        if ($checkbox) {return 1;} else {return 0;}
    }
}
