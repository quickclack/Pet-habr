## About Laravel

### Чистый запуск
```
- cp ./env.example ./.env
- composer install
- npm install
- php artisan project:install
```

### Для локального запуска
```
- php artisan serve
http://127.0.0.1:8000
```

## Если у вас веб сервер apache
```
- в корне каталога создать файл .htaccess
- добавить туда:

RewriteEngine On
RewriteRule (.*) public/$1 
```

## Источники
```
- Тз проекта https://docs.google.com/document/d/1AOXgSPmhXQb33l063dsfqOudUA9_GBW1aVCVRuH_950/edit#
- Доска по задачам в команде https://trello.com/w/gbfinalproject
```
