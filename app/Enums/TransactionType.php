<?php

namespace App\Enums;

enum TransactionType: int
{
    case CASHLESS = 0;
    case COD = 1;
}
