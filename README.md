# donut_hole
Вроде бы сделал все, что требовалось, добавил только проверки на то что работник уже состоит в организации (сообщение не выводится, но на сервере обрабатывается).
не сделал больше проверок на валидность данных и вывод соответствующих ошибок, но хотелось бы.
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
