## Docker
```
{%project_folder%}: docker-compose up -d
http://localhost:8080
```

### Чистый запуск
```
- cp ./env.example ./.env
- composer install
- php artisan project:install
```

### Для локального запуска
```
- php artisan serve
http://127.0.0.1:8000
```

### Smtp mailhog
```
MAIL_HOST=localhost
MAIL_PORT=1025
http://localhost:8025
```
