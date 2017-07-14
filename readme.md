# Laravel 5.4.28 & ZURB Foundation 6.4.1
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"> <img width="250" src="http://foundation.zurb.com/assets/img/homepage/responsive-through-and-through.svg"></p>

Пакет предназначен для разработки сайтов на Laravel 5.4.28 + ZURB Foundation 6.4.1 (Bootstrap вырезан и присутствует только в админ-панеле).

## Установка
Для установки сделайте клон репозитория (или распакуйте в папку).
- Выполните обновление пакетов через `composer update`
- Установите ключ командой `php artisan key:generate`
- `npm install`


## Комплект
- Font Awesome 4.7.0 и Foundation Icon Fonts 3 (отключаются оба и добавлены через CSS, а не SCSS, дабы не ждать компиллирования при watch)
- BrowserSync
- DebugBar [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- Локализация [caouecs/laravel-lang](https://github.com/caouecs/Laravel-lang)
- Админ-панель 4.dev [SleepingOwlAdmin](https://github.com/LaravelRUS/SleepingOwlAdmin)

## BrowserSync
Включается при `npm run watch`. Администрируется через порт `127.0.0.1:3001`

Для отключения уберите в файле `webpack.mix.js` строку `mix.browserSync('larafound.kit')`.

## DebugBar
Для удаления достаточно удалить зависимость `config\app.php`.

## Локализация
Для добавления языка нужно:
- подправить файлик `config\app.php` параметр `locales` (локализацию убирать очень осторожно. Много зависимостей)
- добавить роуты
- поправить посредника `app\Http\Middleware\Locale.php`
- перевести файлы из уже имеющегося языка

Для удаления модуля достаточно удалить 2 зависимости в `config\app.php` и удалить посредника из `app\Http\Kernel.php`.

## SleepingOwlAdmin (603ac4d)
Вход в админ-панель только админам по адресу `/admin` (можно переназначить в настройках).

Демо можно посмотреть [тут](http://demo.sleepingowladmin.ru/).

[Вопросы по админке](https://gitter.im/LaravelRUS/SleepingOwlAdmin).

За админку огромное спасибо [Дейву](https://github.com/aios)

## Flex / обычная сетка
По умолчанию включена flex сетка. Если нужно выключить flex и включить обычную разметку, нужно раскоментировать строчку `@include foundation-everything(false);` в файле `resurses\assets\sass\app.scss`. Соответственно строчку `@include foundation-everything(true);` нужно закомментировать или удалить.

## Добавлено
- Seeds (admin:admin111 - Администратор; user:user111 - Пользователь)
- Регистрация переделана на Ajax + Виды (логин, регистрация, -восстановление пароля, -смена пароля)
- Двухфакторная регистрация (Подтверждение почты по токену)
- Добавлен запрос IP при регистрации пользователя и -верификации почты
- Роли (очень просто - админ и юзер, может еще каких-то)
- База для статических текстов (с мультиязычной поддержкой)

## Прочая информация
- На логаут наложено обновление страницы, дабы не плодить много регов
- Ограничение логина и регистрации до 5 штук в минуту (через роуты и посредника. Кол-во меняется в роутах)

## В планах
- Invisible reCAPTCHA на регистрацию
- Соц реги от laravel/socialite (ФБ, ВК, Гугл, LinkedIn, GitHub, Twitter, Instagram, OK, MailRu, Яндекс)
- Бложик
- Добавить языков (+RU, EN, DE, IT, FR)
- Профайлы и страницу редактирования (CRUD из фронтенда с подключением/отключением социалок к акку)

## Обновление
Последнее обновление сделано 14-07-2017. Работоспособность проверена.

## Вопросы
- [Чатик](https://gitter.im/ZURB-Foundation/Lobby) - там весьма часто.
- skype: neodaan
- почта daan@ukr.net
- telegram @neodaan

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
