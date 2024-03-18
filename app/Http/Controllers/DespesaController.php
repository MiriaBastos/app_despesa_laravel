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

    public function getForm($despesa_id = 0)
    {
        $row = new Despesa();

        if ($despesa_id > 0) {
            $row = Despesa::find($despesa_id);

        }

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
        if ($request->id > 0) {
            $row = Despesa::find($request->id);
        }else{
            $row = new Despesa();
        }

        $row->user_id = Auth::id();
        $row->ano = $request->ano;
        $row->mes = $request->mes;
        $row->dia = $request->dia;
        $row->tipo = $request->tipo;
        $row->descricao = $request->descricao;
        $valorDigitado = $request->valor;

        $valorFormatado = str_replace('.', '', $valorDigitado);
        $valorFormatado = str_replace(',', '.', $valorFormatado);

        $row->valor = $valorFormatado;

        $row->save();

        if(!$request->id) {
            return redirect()->action('\App\Http\Controllers\DespesaController@getForm')
                ->with('success', 'Cadastro realizado com sucesso!');
        } else {
            return redirect()->action('\App\Http\Controllers\DespesaController@getLista')
                ->with('success', 'Cadastro editado com sucesso!');
        }
    }

    public function getLista(Request $request)
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

        $row = (new Despesa())->listaDespesaPorCliente($userId, $request);

        $vars = [
            'row' => $row,
            'request' => $request,
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

        return redirect()->action('\App\Http\Controllers\DespesaController@getLista')
                ->with('success', 'Deletado com sucesso!');
    }

}
