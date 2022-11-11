@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавить статью</h1>
    </div>
@endsection

@section('content')
    <div class="container d-flex flex-column">
        <form action="{{ route('admin.articles.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3 w-50">
                <label for="title" class="form-label">Название</label>
                <x-forms.text-input
                    name="title"
                    :isInvalid="$errors->has('title')"
                    value="{{ old('title') }}">
                </x-forms.text-input>
            </div>

            <div class="mb-3 w-50">
                <label for="description" class="form-label">Описание</label>
                <x-forms.text-input
                    name="description"
                    :isInvalid="$errors->has('description')"
                    value="{{ old('description') }}">
                </x-forms.text-input>
            </div>

            <label class="form-label" for="category_id">Категории</label>
            <select class="form-control mb-2 w-50" id="category_id" name="category_id">
                @foreach($categories as $key => $values)
                    <option value="{{ $key }}">{{ $values }}</option>
                @endforeach
            </select>

            <label class="form-label" for="tags">Теги</label>
            <select class="form-control mb-2 w-50" multiple="multiple" id="tags" name="tags[]">
                @foreach($tags as $key => $values)
                    <option value="{{ $key }}">{{ $values }}</option>
                @endforeach
            </select>

            <div class="mb-3 w-50">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" class="form-control" name="image">
            </div>

            <x-forms.primary-button>Добавить</x-forms.primary-button>
        </form>
    </div>
@endsection
