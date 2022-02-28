@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex flex-row justify-content-between">
                    <span class="my-auto">{{ __('Drinks') }}</span>
                    <a href="{{ route('drinks.create') }}" class="btn btn-success">Adicionar</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Bebida alcoólica</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-list"></i>Detalhes</a>
                                    <a href="#" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pencil"></i>Editar</a>
                                    <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i>Excluir</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
