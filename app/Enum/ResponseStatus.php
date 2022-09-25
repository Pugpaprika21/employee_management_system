<?php

namespace App\Enum;

enum ResponseStatus: int
{
    case OK           = 200;
    case CLIENT_ERROR = 400;
    case SERVER_ERROR = 500;
}
