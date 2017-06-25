# Laravel 5.4 & ZURB Foundation 6.3.1
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"> <img width="250" src="http://foundation.zurb.com/assets/img/homepage/responsive-through-and-through.svg"></p>

Пакет предназначен для разработки сайтов на Laravel 5.4 + ZURB Foundation (Bootstrap вырезан и присутствует только в админ-панеле).

## Установка
Для установки сделайте клон репозитория (или распакуйте в папку).
- Выполните обновление пакетов через `composer update`
- Установите ключ командой `php artisan key:generate`
- `npm install`


## Комплект
- BrowserSync
- DebugBar [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- Локализация [caouecs/laravel-lang](https://github.com/caouecs/Laravel-lang)
- Админ-панель 4.dev [SleepingOwlAdmin](https://github.com/LaravelRUS/SleepingOwlAdmin)

## BrowserSync
Включается при `npm run watch`. Администрируется через порт `127.0.0.1:3001`

Для отключения уберите в файле `webpack.mix.js` строку `mix.browserSync('larafound.kit')`.

## DebugBar
Для удаления достаточно удалить зависимость `/config/app.php`.

## Локализация
Для добавления языка нужно:
- подправить файлик `/config/app.php` параметр `locales`
- добавить роуты
- поправить посредника `/app/Http/Middleware/Locale.php`

Для удаления модуля достаточно удалить 2 зависимости в `/config/app.php` и удалить посредника.

## SleepingOwlAdmin
Вход в админ-панель без пароля по адресу `/admin` (можно переназначить в настройках).

Демо можно посмотреть [тут](http://demo.sleepingowladmin.ru/).

[Вопросы](https://gitter.im/LaravelRUS/SleepingOwlAdmin).

## Flex / обычная сетка
По умолчанию включена flex сетка. Если нужно выключить flex и включить обычную разметку, нужно раскоментировать строчку `@include foundation-everything(false);` в файле `/resurses/assets/sass/app.scss`. Соответственно строчку `@include foundation-everything(true);` нужно закомментировать или удалить.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
