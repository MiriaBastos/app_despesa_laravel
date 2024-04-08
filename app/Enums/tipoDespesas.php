<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Attributes\Description;

final class tipoDespesas extends Enum
{
    #[Description('Alimentação')]
    const ALIMENTACAO = '1';

    #[Description('Educação')]
    const EDUCACAO = '2';

    #[Description('Lazer')]
    const LAZER = '3';

    #[Description('Casa')]
    const CASA = '8';

    #[Description('Saúde')]
    const SAUDE = '4';

    #[Description('Transporte')]
    const TRANSPORTE = '5';

    #[Description('Empréstimo')]
    const EMPRESTIMO = '6';

    #[Description('Extras')]
    const EXTRAS = '7';
}
