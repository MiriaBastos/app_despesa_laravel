<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

final class despesasRecorrenteStatus extends Enum
{
    #[Description('Não Recorrente')]
    const NAO_RECORRENTE = 0;

    #[Description('Recorrente')]
    const RECORRENTE = 1;

    public static function getHtmlLabel($value): string
    {
        $statusClass = 'default';

        switch ($value) {
            case self::RECORRENTE:
                $statusClass = 'success';
                break;
            case self::NAO_RECORRENTE:
                $statusClass = 'warning';
                break;
        }

        return "<label class='label label-$statusClass'>" . self::getDescription($value) . "</label>";
    }
}
