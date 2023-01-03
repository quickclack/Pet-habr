@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Редактировать: {{ $user->nickName }}</h1>
    </div>
@endsection

@section('content')
    <div class="container d-flex flex-column">
        <form action="{{ route('admin.users.update', ['user' => $user]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3 w-50 flex-column">
                <label class="form-label me-3" for="banned">Заблокировать</label>
                <input class="form-check-input"
                       type="checkbox"
                       id="banned"
                       name="banned"
                       @if(isset($user->banned->banned)) checked @endif/>
            </div>

            @if(auth('sanctum')->user()->getRole() == 'Administrator')
                <div class="mb-3 w-50">
                    <label class="form-label" for="role">Роль</label>
                    <select class="form-control mb-2 w-50" id="role" name="role">
                        @foreach($roles as $key => $values)
                            <option value="{{ $key }}" @if($user->getRole() == $values) selected @endif>{{ $values }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <x-forms.primary-button>Изменить</x-forms.primary-button>
        </form>
    </div>
@endsection
