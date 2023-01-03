@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Заблокированные пользователи</h1>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        @if(!$banned->isEmpty())
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Никнейм</th>
                    <th scope="col">Забанен</th>
                    <th scope="col">Начало</th>
                    <th scope="col">Конец</th>
                </tr>
                </thead>
                <tbody>

                @foreach($banned as $ban)
                    <tr>
                        <td>{{ $ban->id }}</td>
                        <td>{{ $ban->user->nickName }}</td>
                        <td>{{ $ban->banned ? 'true' : 'false' }}</td>
                        <td>{{ $ban->banned_start->format('d-m-Y h:m:s') }}</td>
                        <td>{{ $ban->banned_end->format('d-m-Y h:m:s') }}</td>
                    </tr>
                @endforeach

                @else
                    <div class="container text-center">
                        <h2 class="h4 fw-light">Еще нет забаненных пользователей</h2>
                    </div>
                @endif
                </tbody>
            </table>
    </div>
@endsection
