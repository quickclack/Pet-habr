@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить тэг</h1>
    </div>
@endsection

@section('content')
    <div class="container d-flex flex-column">
        <form action="{{ route('admin.tags.store') }}" method="post">
            @csrf
            <div class="mb-3 w-50">
                <label for="title" class="form-label">Title</label>
                <x-forms.text-input
                    name="title"
                    :isInvalid="$errors->has('title')"
                    value="{{ old('title') }}">
                </x-forms.text-input>
            </div>

            <x-forms.primary-button>Добавить</x-forms.primary-button>
        </form>
    </div>
@endsection
