# Test Task: Laravel Form

## Установка

Используется MySQL, т.к. в PostgreSQL нет типа данных `SET`. В Laravel он реализован только для MySQL.

```bash
git clone git@github.com:saippuakauppias/test-task-laravel-form.git
cd test-task-laravel-form
composer install
# create mysql database like
# mysql -uroot -p12345 -e "CREATE DATABASE laravelform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
# change db connect variables in `.env`
php artisan migrate --seed
# run `php artisan serve` or use Valet for open in browser
```

## Условия

Нужно сделать форму оформления заказа для сайта (Некоторое подобие заказа ГФ).

Для оформления заказа клиент должен:

1. указать телефон и имя
2. выбрать тариф
3. выбрать первый день доставки (из возможных для данного тарифа) и адрес

После оформления заказа в БД должна появиться запись о заказе и клиенте (если такого клиента не было до этого) .

Все указанные клиентом данные должны быть сохранены.

Все заказы с одним номером телефона должны привязаться к одному клиенту в БД. Клиентов с одинаковым номером телефона не должно быть в БД.

Тарифы предварительно занесены в БД, у каждого тарифа есть название, цена, и дни недели по которым он может доставляться.

## Требования

Бэк: PHP, с фреймворком laravel

БД: mysql, postgresql

Фронт: верстка bootstrap, все данные через ajax, оформление заказа без перезагрузки страницы. Желательно использование Vue.js.

## Дополнительно-обязательно

Дано:

1. таблица clients, поля id, name
2. таблица orders, поля id, client_id, price

Надо:

1. Выбрать для каждого клиента количество заказов ценой меньше 1000 и больше 1000. (client_id, count1, count2)
2. Выбрать третий заказ для каждого клиента ( id, client_id, price)
3. Выбрать для каждого клиента третий заказ сделанный после заказа стоимостью больше 1000 ( id, client_id, price)
