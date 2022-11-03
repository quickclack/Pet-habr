@extends('admin.layouts.layout')

@section('title')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Панель администратора</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar" class="align-text-bottom"></span>
                This week
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <div class="alert alert-danger">
            <h6 class="fw-light">Ошибка</h6>
        </div>
        <div class="alert alert-success">
            <h6 class="fw-light">Это сообщение было добавлено динамически</h6>
        </div>
        <div class="alert alert-warning">
            <h6 class="fw-light">Ворнинг</h6>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Роли и права пользователей</h1>
    </div>

    <div class="d-flex flex-column">
        <h5 class="fw-light">1 - Администратор</h5>
        <h5 class="fw-light">2 - Менеджер</h5>
        <h5 class="fw-light">0 - Пользователь</h5>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Статусы статей</h1>
    </div>

    <div class="d-flex flex-column">
        <h5 class="fw-light">0 - Новая</h5>
        <h5 class="fw-light">5 - Подтверждена</h5>
        <h5 class="fw-light">10 - Отклонена</h5>
    </div>
@endsection
