@extends('emails.layouts.layout')

@section('content')
    <div class="container mt-5 bg-light text-center">
        <h1 class="h2 mt-5">Подтверждение email</h1>

        <p>Пожалуйста нажмите на кнопку, что бы подтвердить:</p>
        <form action="{{ route('user.verify', $token) }}" method="post">
            @csrf

            <button class="btn btn-primary mb-3">Подтвердите email</button>
        </form>
    </div>
@endsection
