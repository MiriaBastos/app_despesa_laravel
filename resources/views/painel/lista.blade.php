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

                    @if(session('success'))
                        <div id="successMessage" class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <div class="col-sm-12">
                                {{ html()
                                        ->modelForm($row, 'GET', action('\App\Http\Controllers\DespesaController@getLista'))
                                        ->id('formAdicionarEditar')
                                        ->open()
                                }}
                                {{ html()->hidden('id') }}
                                <br>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        {{ html()
                                            ->text('descricao', $request->descricao)
                                            ->class('form-control')
                                        }}
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="tipo" class="form-label">Tipo de Despesa</label>
                                        {{ html()
                                            ->select('tipo', ['' => 'Não informado'] + $ddltipo, $request->tipo)
                                            ->class('form-control')
                                        }}
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="dia" class="form-label">Dia</label>
                                        {{ html()
                                            ->number('dia', $request->dia)
                                            ->class('form-control')
                                        }}
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="mes" class="form-label">Mês</label>
                                        {{ html()
                                            ->select('mes', ['' => 'Não informado'] + $ddlmes, $request->mes)
                                            ->class('form-control')
                                        }}
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="ano" class="form-label">Ano</label>
                                        {{ html()
                                            ->select('ano', ['' => 'Não informado'] + $ddlano, $request->ano)
                                            ->class('form-control')
                                        }}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="data_batida_de">Data de cadastro de</label>
                                                {{ html()
                                                    ->date("data_cadastro_de", $data_cadastro_de)
                                                    ->class('form-control')
                                                }}
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="data_batida_ate">Data de cadastro ate</label>
                                                {{ html()
                                                    ->date("data_cadastro_ate", $data_cadastro_ate)
                                                    ->class('form-control')
                                                }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12 text-end">
                                        {{ html()
                                            ->button('PESQUISAR')
                                            ->type('submit')
                                            ->class('btn btn-outline-info')
                                        }}
                                        <a href="{{ action('\App\Http\Controllers\DespesaController@getLista') }}"
                                            class="btn btn-outline-secondary">
                                            LIMPAR FILTRO
                                        </a>
                                        <a href="#"
                                            class="btn btn-outline-primary btnexcel">
                                            BAIXAR RELATÓRIO EM EXCEL
                                        </a>
                                    </div>
                                </div>
                                {{ html()->form()->close() }}

                                <br>
                                <br>

                                <table style="width: 100%" class="table table-striped table-hover" id="dataTableHorario"
                                    data-url="#">
                                    <thead>
                                        <tr class="bg-blue">
                                            <th>Cód.</th>
                                            <th>Descrição</th>
                                            <th class="text-center">Tipo Despesa</th>
                                            <th>Dia</th>
                                            <th>Mês</th>
                                            <th>Ano</th>
                                            <th>Valor</th>
                                            <th>Dt Cadastro</th>
                                            <th>Desp. Recorrente</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="listaDespesas">
                                        @php
                                            $totalDespesas = 0;
                                        @endphp
                                        @foreach ($row as $despesas)
                                            @php
                                                $totalDespesas += $despesas->valor;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $despesas->id }}
                                                </td>
                                                <td>
                                                    {{ $despesas->descricao }}
                                                </td>
                                                <td class="text-center">
                                                    {{ App\Enums\tipoDespesas::getDescription($despesas->tipo) }}
                                                </td>
                                                <td>
                                                    {{ $despesas->dia }}
                                                </td>
                                                <td>
                                                    {{ App\Models\Despesa::mesesEmPortugues()[$despesas->mes] }}
                                                </td>
                                                <td>
                                                    {{ $despesas->ano }}
                                                </td>
                                                <td>
                                                    {{ number_format($despesas->valor, 2, ',', '.') }}
                                                </td>
                                                <td>
                                                    {{ date('d/m/Y', strtotime($despesas->created_at)) }}

                                                </td>
                                                <td>
                                                    {!! App\Enums\despesasRecorrenteStatus::getHtmlLabel($despesas->despesa_recorrente) !!}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{action('\App\Http\Controllers\DespesaController@getForm', ['despesa_id'=> $despesas->id])}}" class="btn btn-sm btn-warning">
                                                        <i class="fa fa-pencel"></i>
                                                        Editar
                                                    </a>

                                                    <a href="{{action('\App\Http\Controllers\DespesaController@getDeleteDespesa', ['despesa_id'=> $despesas->id])}}" class="btn btn-sm btn-danger alertaExcluir">
                                                        <i class="fa fa-trash"></i>
                                                        Excluir
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-right"><strong>TOTAL:</strong></td>
                                            <td>{{ number_format($totalDespesas, 2, ',', '.') }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('javascript')
        <script>
            setTimeout(function() {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000); // 5000 milissegundos = 5 segundos

            $('.btnexcel').click(function() {
                alert('Em construção, aguarde!! Metal e Miriã estão trabalhando');
            });

            $('.alertaExcluir').click(function() {
                if (confirm('Deseja realmente excluir esta despesa?')) {
                    window.location.reload();
                } else {
                    alert('Exclusão cancelada pelo usuário.');
                    return false;
                }
            });
        </script>
    @endpush
</x-app-layout>
