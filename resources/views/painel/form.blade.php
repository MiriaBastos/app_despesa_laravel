<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-600 leading-tight">
            {{ __('Registro de nova despesa') }}
        </h2>
    </x-slot>
    <br><br>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            {{ html()
                                ->modelForm($row, 'POST', action('\App\Http\Controllers\DespesaController@postForm'))
                                ->id('formAdicionarEditar')
                                ->open()
                            }}
                                <div class="row mb-3">
                                    <div class="col-sm-2">
                                        <label for="dia" class="form-label">Dia</label>
                                        {{ html()
                                            ->text('dia')
                                            ->class('form-control')
                                            ->id('dia')
                                            ->required()
                                        }}
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="mes" class="form-label">Mês</label>
                                        {{ html()
                                            ->select('mes', ['' => 'Selecione o Mês'] + $ddlmes)
                                            ->class('form-control')
                                            ->id('mes')
                                            ->required()
                                        }}
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="ano" class="form-label">Ano</label>
                                        {{ html()
                                            ->select('ano', ['' => 'Selecione o Ano'] + $ddlano)
                                            ->class('form-control')
                                            ->id('ano')
                                            ->required()
                                        }}
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="tipo" class="form-label">Tipo de Despesa</label>
                                        {{ html()
                                            ->select('tipo', ['' => 'Não informado'] + $ddltipo)
                                            ->class('form-control')
                                            ->id('tipo')
                                            ->required()
                                        }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        {{ html()
                                            ->text('descricao')
                                            ->class('form-control')
                                            ->required()
                                        }}
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="valor" class="form-label">Valor</label>
                                        {{ html()
                                            ->text('valor')
                                            ->class('form-control')
                                            ->id('valor')
                                            ->required()
                                        }}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                                    </div>
                                </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
