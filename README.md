Архитектура приложения

Структура директорий и файлов

/ShogoTest

|-- /controllers
|   |-- ProductController.php
|   |-- UserController.php
|-- /models
|   |-- Product.php
|   |-- User.php
|-- /views
|   |-- product
|   |   |-- index.php
|   |   |-- view.php
|   |   |-- create.php
|   |-- auth
|       |-- login.php
|       |-- register.php
|-- /helpers
|   |-- Database.php
|-- index.php
|-- .htaccess

Описание файлов
controllers/
ProductController.php: Контроллер для управления продуктами (список, просмотр, создание).
UserController.php: Контроллер для управления пользователями (регистрация, вход, выход).
models/
Product.php: Модель для работы с продуктами.
User.php: Модель для работы с пользователями.
views/
product/: Представления для управления продуктами (список, просмотр, создание).
index.php: Отображение списка продуктов.
view.php: Отображение информации о продукте.
create.php: Форма для создания нового продукта.
auth/: Представления для управления аутентификацией.
login.php: Форма для входа.
register.php: Форма для регистрации.
helpers/
Database.php: Класс для работы с базой данных.
index.php: Основной файл маршрутизации.
.htaccess: Конфигурационный файл для переадресации запросов.
