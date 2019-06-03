<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

final class TitleType extends AbstractEnumType
{
    protected const TITLE_MR = 'mr';
    protected const TITLE_MS = 'ms';

    protected static $choices = [
        self::TITLE_MR => self::TITLE_MR,
        self::TITLE_MS => self::TITLE_MS,
    ];
}
