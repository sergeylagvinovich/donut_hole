
# donut_hole
Чтобы развернуть:
Установите docker и docker-compose.

Скопируйте .env

```shell
cp .env.example .env
```

Ставим зависимости
```shell
docker-compose run --rm back composer install
```

Запускаем
```shell
docker-compose up
```

Создаем базу данных
```shell
docker-compose exec db psql -U postgres -c "create database backend;"
```

Запуск команд artisan
```shell
docker-compose exec back php artisan migrate
# можно выполнить seed для заполнения базы данных тестовыми параметрами
docker-compose exec back php artisan db:seed --class=DepartmentsSeeder
docker-compose exec back php artisan db:seed --class=EmployeesSeeder
docker-compose exec back php artisan db:seed --class=DataSeeder
```
OpenApi
[donut-hole-1.0.0-resolved.zip](https://github.com/sergeylagvinovich/donut_hole/files/6990973/donut-hole-1.0.0-resolved.zip)
