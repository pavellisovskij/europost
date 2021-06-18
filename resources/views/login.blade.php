@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Вход</div>

                <div class="card-body">
                    @if(session('error'))
                        <p class="alert alert-danger">{{ session('error') }}</p>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
