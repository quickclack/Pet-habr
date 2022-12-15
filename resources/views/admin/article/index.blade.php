@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список статей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @can('create', $articles->first())
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-outline-secondary">Добавить статью</a>
                @endcan
                <a href="{{ route('admin.articles.new') }}" class="btn btn-sm btn-outline-secondary">Новые статьи ({{ $countNewArticle }})</a>
                <a href="{{ route('admin.articles.trash') }}" class="btn btn-sm btn-outline-secondary">Отклонённые статьи ({{ $countRejectedArticle }})</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        @if(count($articles))
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Author</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>

                @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->description }}</td>
                        <td>{{ $article->user->email ?? '-' }}</td>
                        <td>{{ $article->category_id }}</td>
                        <td>{{ $article->status->getStatus() }}</td>

                        @canany(['update', 'delete'], $article)
                            <td>
                                <a href="{{ route('admin.articles.edit', ['article' => $article->id]) }}"
                                   class="btn btn-primary btn-sm text-white">Изменить</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.articles.destroy', ['article' => $article->id]) }}"
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
                        <h2 class="h4 fw-light">Статей пока нет..</h2>
                    </div>
                @endif
                </tbody>
            </table>

            <div class="container mt-3">
                <div>{{ $articles->links() }}</div>
            </div>
    </div>
@endsection
