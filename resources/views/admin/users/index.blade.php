@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список Пользователей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.users.banned') }}" class="btn btn-sm btn-outline-secondary">Заблокированные пользователи</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        @if(!$users->isEmpty())
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Никнейм</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Email</th>
                    <th scope="col">Зарегистрирован</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Бан</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->nickName }}</td>
                        <td>{{ $user->firstName ?? '--' }}</td>
                        <td>{{ $user->lastName ?? '--' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        <td>{{ $user->getRole() ?? '--' }}</td>
                        <td>{{ isset($user->banned->banned) ? 'true' : 'false' }}</td>

                        <td class="d-flex justify-content-end">
                            <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                               class="btn btn-primary btn-sm text-white">Изменить</a>
                            @can('delete', $user)
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <x-forms.delete-button>Удалить</x-forms.delete-button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach

                @else
                    <div class="container text-center">
                        <h2 class="h4 fw-light">Еще нет зарегистрированных пользователей</h2>
                    </div>
                @endif
                </tbody>
            </table>
    </div>
@endsection
