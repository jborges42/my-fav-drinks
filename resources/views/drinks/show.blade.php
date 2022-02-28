@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="my-auto text-uppercase">{{ $drink->name }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-uppercase"><b>{{$drink->name}}</b></li>
                        <li class="list-group-item text-uppercase"><b>{{ $drink->is_alcohol ? 'Bebida alcoólica' : 'Bebida não alcoólica' }} </b></li>
                    </ul>

                    <a href="{{ route('drinks.index') }}" class="btn btn-secondary">Voltar</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
