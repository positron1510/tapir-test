Для того чтобы запустить проект:

1. Переходим в папку проекта
2. docker-compose build
3. docker-compose up -d

переименовываем .env.example в .env

подтягиваем зависимости

composer install

Далее заходим в bash контейнера fpm:
docker-compose exec fpm bash

и выполняем миграции таблиц

php artisan migrate

генерим ключ приложения

php artisan key:generate

выходим из bash

exit

Сервис доступен по адресу http://localhost:8098

Методы API:

1. Получение всех записей (пагинация по 10 записей)
GET http://localhost:8098/api/v1/advertisement
Необязательные параметры: order_by_created_at, order_by_price значения asc и desc, per_page страница пагинации

2. Добавление записи
POST http://localhost:8098/api/v1/advertisement
Обязательные параметры: title, description, price, photos (массив)

3. Получение записи по идентификатору
GET http://localhost:8098/api/v1/advertisement/get
Обязательный параметр: id (целочисленный идентификатор объявления)
