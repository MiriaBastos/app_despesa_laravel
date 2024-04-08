<?php

namespace App\Http\Controllers;

use App\Enums\despesasRecorrenteStatus;
use App\Enums\tipoDespesas;
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

        $ddlmes = Despesa::mesesEmPortugues();

        $ddlano = Despesa::dropDownAno();

        $ddltipo = tipoDespesas::asSelectArray();

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

        if ($request->despesa_recorrente == 1) {
            $row->despesa_recorrente = $request->despesa_recorrente;
        }else {
            $row->despesa_recorrente = despesasRecorrenteStatus::NAO_RECORRENTE;
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

        $data_cadastro_de = date('Y-m-01');
        $data_cadastro_ate = date('Y-m-d');

        $ddltipo = tipoDespesas::asSelectArray();

        $ddlmes = Despesa::mesesEmPortugues();

        $ddlano = Despesa::dropDownAno();

        $row = (new Despesa())->listaDespesaPorCliente($userId, $request);

        $vars = [
            'row' => $row,
            'request' => $request,
            'ddltipo' => $ddltipo,
            'ddlmes' => $ddlmes,
            'ddlano' => $ddlano,
            'data_cadastro_de' => $data_cadastro_de,
            'data_cadastro_ate' => $data_cadastro_ate,
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
