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
            $query->whereMonth('mes', $request->mes);
        }

        if ($request->ano) {
            $query->whereYear('ano', $request->ano);
        }

        return $query->get();
    }

    public function deletaDespesa($despesa_id)
    {
        return $this->where('id', $despesa_id)->delete();
    }

}
