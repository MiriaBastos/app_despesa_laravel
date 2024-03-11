<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 leading-tight">
            {{ __('Consulta de despesas') }}
        </h2>
    </x-slot>
    <br><br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12">
                                {{ html()
                                    ->form( action('\App\Http\Controllers\DespesaController@getLista'))
                                    ->id('formAdicionarEditar')
                                    ->open()
                                }}
                                {{ html()->hidden('id') }}
                                <br>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        {{ html()
                                            ->text('descricao')
                                            ->class('form-control')
                                        }}
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="tipo" class="form-label">Tipo de Despesa</label>
                                        {{ html()
                                            ->select('tipo', ['' => 'Não informado'] + $ddltipo)
                                            ->class('form-control')
                                            ->id('tipo')
                                            ->required()
                                        }}
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="mes" class="form-label">Mês</label>
                                        {{ html()
                                            ->select('mes', ['' => 'Não informado'] + $ddlmes)
                                            ->class('form-control')
                                            ->id('mes')
                                            ->required()
                                        }}
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="ano" class="form-label">Ano</label>
                                        {{ html()
                                            ->select('ano', ['' => 'Não informado'] + $ddlano)
                                            ->class('form-control')
                                            ->id('ano')
                                            ->required()
                                        }}
                                    </div>

                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm-12 text-end">
                                        {{ html()->button('PESQUISAR')->type('submit')->class('btn btn-outline-info') }}
                                    </div>
                                </div>
                                {{ html()->form()->close() }}
                                <br><br>
                                <table style="width: 100%" class="table table-striped table-hover" id="dataTableHorario"
                                    data-url="#">
                                    <thead>
                                        <tr class="bg-blue">
                                            <th>Cód.</th>
                                            <th>Descrição</th>
                                            <th class="text-center">Tipo Despesa</th>
                                            <th>Mês</th>
                                            <th>Ano</th>
                                            <th>Valor</th>
                                            <th>Dt Cadastro</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">
                                        @foreach ($row as $despesas)
                                            <tr>
                                                <td>
                                                    {{ $despesas->id }}
                                                </td>
                                                <td>
                                                    {{ $despesas->descricao }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $despesas->tipo }}
                                                </td>
                                                <td>
                                                    {{ $despesas->mes }}
                                                </td>
                                                <td>
                                                    {{ $despesas->ano }}
                                                </td>
                                                <td>
                                                    {{ $despesas->valor }}
                                                </td>
                                                <td>
                                                    {{ $despesas->created_at }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{action('\App\Http\Controllers\DespesaController@getDeleteDespesa', ['despesa_id'=> $despesas->id])}}" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                        Excluir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
