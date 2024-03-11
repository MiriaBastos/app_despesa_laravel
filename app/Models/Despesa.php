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

    public function listaDespesaPorCliente($userId)
    {
        $ret = [];
        $selectBase = $this->select()->where('user_id', $userId)->get();

        foreach($selectBase as $row) {
            $ret[] = $row;
        }

        return $ret;
    }

    public function deletaDespesa($despesa_id)
    {
        return $this->where('id', $despesa_id)->delete();

    }

}
