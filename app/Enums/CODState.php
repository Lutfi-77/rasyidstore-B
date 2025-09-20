<?php

namespace App\Enums;

enum CODState: int
{
    case TRANSACTION = 0;
    case VERIFY_ORDER  = 1;
    case DELIVERY = 2;
    case PAYMENT = 3;
    case DONE = 4;
}
