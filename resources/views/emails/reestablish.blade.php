@extends('emails.layouts.layout')

@section('content')
    <div class="body-wrap">
        <div class="container">
            <div class="content">
                <h3>Ваш временный пароль</h3>
                <p class="lead">Временный пароль: {{ $password }}</p>
                <p class="callout">
                    Совет: поменяйте его в личном кабинете, что бы не произошло утечки данных
                    <a href="{{ url('/login') }}">Перейти на форму авторизации &raquo;</a>
                </p>
            </div>
        </div>
    </div>
@endsection
