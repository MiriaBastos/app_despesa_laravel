<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DespesaController extends Controller
{
    public function getIndex()
    {
        return "Financeiro";
    }

    public function getForm($id = 0)
    {
        $row = new Despesa();

        $ddlmes = [
            '1' => 'janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];

        $ddlano = [
            '2024' => '2024',
            '2025' => '2025',
        ];

        $ddltipo = [
            '1' => 'Alimentação',
            '2' => 'Educação',
            '3' => 'Lazer',
            '4' => 'Saúde',
            '5' => 'Transporte',
        ];

        $vars = [
            'row' => $row,
            'ddlmes' => $ddlmes,
            'ddlano' => $ddlano,
            'ddltipo' => $ddltipo,
        ];

        return view('painel.form', $vars);
    }

    public function postForm(Request $request)
    {
        $row = new Despesa();
        $userId = Auth::id();

        $row->user_id  = $userId;

        $row->ano  = $request->ano;
        $row->mes = $request->mes;
        $row->dia = $request->dia;
        $row->tipo = $request->tipo;
        $row->descricao = $request->descricao;
        $row->valor = $request->valor;

        $row->save();

        return redirect()->action('\App\Http\Controllers\DespesaController@getForm');
    }

    public function getLista()
    {
        $userId = Auth::id();

        $ddltipo = [
            '1' => 'Alimentação',
            '2' => 'Educação',
            '3' => 'Lazer',
            '4' => 'Saúde',
            '5' => 'Transporte',
        ];

        $ddlmes = [
            '1' => 'janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro',
        ];

        $ddlano = [
            '2024' => '2024',
            '2025' => '2025',
        ];

        $row = (new Despesa())->listaDespesaPorCliente($userId);

        $vars = [
            'row' => $row,
            'ddltipo' => $ddltipo,
            'ddlmes' => $ddlmes,
            'ddlano' => $ddlano,
        ];

        return view('painel.lista', $vars);
    }

    public function getDeleteDespesa($despesa_id)
    {
        $variavel = new Despesa();
        $row = $variavel->deletaDespesa($despesa_id);

        if ($row == null) {
            return "Falha ao Deletar";
        }

        return redirect()->action('\App\Http\Controllers\DespesaController@getLista');
    }

}
