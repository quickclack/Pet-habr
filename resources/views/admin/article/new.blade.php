@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список новых статей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-secondary">Список новых статей</a>
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
                        <td>{{ $article->user->nickName ?? '-' }}</td>
                        <td>{{ $article->category->title ?? '-' }}</td>
                        <td>{{ $article->status->getStatus() }}</td>

                        <td>
                            <form action="{{ route('admin.article.approve', ['id' => $article->id]) }}"
                                  method="post">
                                @csrf

                                <button type="submit" class="btn btn-primary btn-sm text-white">Принять</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.article.reject', ['id' => $article->id]) }}"
                                  method="post">
                                @csrf

                                <button type="submit" class="btn btn-danger ms-3 btn-sm">Отклонить</button>
                            </form>
                        </td>
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
