@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="my-auto">{{ __('Adicionar bebida') }}</span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('drinks.update') }}"  method="POST" id="drink-form">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="isAlcohol" name="isAlcohol">
                                <label class="form-check-label" for="isAlcohol">
                                    Bebida alcoólica?
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" form="drink-form" class="btn btn-md btn-success"  value="Adicionar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
