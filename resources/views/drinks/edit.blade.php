@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Editar - <span class="my-auto text-uppercase"> {{ $drink->name }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('drinks.update', $drink->id) }}"  method="POST" id="drink-form">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $drink->name }}" required>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="isAlcohol" name="isAlcohol" {{ $drink->is_alcohol ? 'checked' : '' }}>
                                <label class="form-check-label" for="isAlcohol">
                                    Bebida alcoólica?
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" form="drink-form" class="btn btn-md btn-success"  value="Atualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
