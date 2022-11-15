<?php

namespace Support\Enums;

enum ArticleStatus: int
{
    case NEW = 0;
    case APPROVED = 5;
    case REJECTED = 10;
}
