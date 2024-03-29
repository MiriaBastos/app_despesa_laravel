<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Despesa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'cli_despesas';

    public function listaDespesaPorCliente($userId, $request)
    {
        $query = $this->select()
                      ->where('user_id', $userId);

        if ($request->descricao) {
            $descricao = $request->descricao;
            $query->where('descricao', 'LIKE', "%$descricao%");
        }

        if ($request->tipo) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->mes) {
            $query->where('mes', $request->mes);
        }

        if ($request->ano) {
            $query->where('ano', $request->ano);
        }

        return $query->get();
    }

    public function deletaDespesa($despesa_id)
    {
        return $this->where('id', $despesa_id)->delete();
    }

    public static function mesesEmPortugues()
    {
        return [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];
    }

    public static function dropDowmTipoCategoria()
    {
        return [
            1 => 'Alimentação',
            2 => 'Educação',
            3 => 'Lazer',
            4 => 'Saúde',
            5 => 'Transporte',
        ];
    }
}
