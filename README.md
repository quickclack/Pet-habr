## About Laravel

### Чистый запуск
```
{%project_folder%}: cp ./env.example ./.env
{%project_folder%}: composer install
{%project_folder%}: npm install
{%project_folder%}: php artisan project:install
```

### Для локального запуска
```
{%project_folder%}: php artisan serve
http://127.0.0.1:8000
```

## Если у вас веб сервер apache
```
- в корне каталога создать файл .htaccess
- добавить туда:

RewriteEngine On
RewriteRule (.*) public/$1 
```
