<?php

namespace App\Enums;

enum BookAgeClassification: int
{
    case MID_CHILD = 8;
    case CHILD     = 10;
    case MID_YOUNG = 12;
    case YOUNG     = 13;
    case YOUNGER   = 17;
    case YOUTH     = 21;

    public function getAge()
    {
        return $this->value;
    }
}
