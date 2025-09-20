<?php

namespace App\Enums;

enum MediaType: int
{
    case IMAGE = 0;
    case VIDEO = 1;
    case THUMBNAIL = 2;
}
