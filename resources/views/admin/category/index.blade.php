@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список категорий</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @can('create', $categories->first())
                    <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-outline-secondary">Добавить</a>
                @endcan
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        @if(count($categories))
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Slug</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>

                        @canany(['update', 'delete'], $category)
                            <td class="d-flex justify-content-end">
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                   class="btn btn-primary btn-sm text-white">Изменить</a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <x-forms.delete-button>Удалить</x-forms.delete-button>
                                </form>
                            </td>
                        @endcanany
                    </tr>
                @endforeach

                @else
                    <div class="container text-center">
                        <h2 class="h4 fw-light">Категорий пока нет..</h2>
                    </div>
                @endif
                </tbody>
            </table>
    </div>
@endsection
