<?php

namespace App\Enums;

use App\Interfaces\EnumWithListsInterface;
use App\Traits\EnumListsTrait;

enum CampaignStatusEnum: string implements EnumWithListsInterface
{
    use EnumListsTrait;

    case ACTIVE = 'ativo';
    case SUSPENDED = 'suspenso';
    case EXTENDED = 'prorrogado';
}
