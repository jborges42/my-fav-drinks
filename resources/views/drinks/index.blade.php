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
                    @if (session('alert') )
                    <div class="alert {{ session('alert')['type'] }}" role="alert">
                        {{ session('alert')['message'] }}
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
                            @foreach ($drinks as $drink )
                            <tr>
                                <th scope="row"> {{ $drink->id }} </th>
                                <td>{{ $drink->name }}</td>
                                <td>
                                    <input class="form-check-input" type="checkbox" {{ $drink->is_alcohol ? 'checked' : '' }} disabled>
                                </td>
                                <td class="d-flex flex-row justify-content-left">
                                    <a href="{{ route('drinks.show', $drink->id) }}" class="btn btn-sm btn-primary mx-2"><i class="fa-solid fa-list"></i>Detalhes</a>
                                    <a href="{{ route('drinks.edit', $drink->id) }}" class="btn btn-sm btn-secondary mx-2"><i class="fa-solid fa-pencil"></i>Editar</a>
                                    <form action="{{route('drinks.destroy', $drink->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger mx-2" onclick="return confirm('Você realmente deseja excluir {{$drink->name}}?');"><i class="fa-solid fa-trash"></i>Excluir</button>
                                    </form>
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
@endsection
