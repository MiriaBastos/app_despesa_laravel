<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

final class despesasRecorrenteStatus extends Enum
{
    #[Description('Inativo')]
    const INATIVO = 0;

    #[Description('Ativo')]
    const ATIVO = 1;
}
