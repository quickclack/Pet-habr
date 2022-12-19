<?php

namespace Enums;

enum UserRole: int
{
    case ADMINISTRATOR = 1;
    case MODERATOR = 2;
    case USER = 3;
}
