# Laravel 5.5.13 & ZURB Foundation 6.4.3
<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"> <img width="250" src="http://foundation.zurb.com/assets/img/homepage/responsive-through-and-through.svg"></p>

Пакет предназначен для разработки сайтов на Laravel 5.5 + ZURB Foundation 6.4 (Bootstrap вырезан и присутствует только в админ-панели).

## Особенности
Обновился до 5.5 без фиксов. Ошибок не замечено

## Установка
Для установки сделайте клон репозитория (или распакуйте в папку).
- Выполните обновление пакетов через `composer update`
- Установите ключ командой `php artisan key:generate`
- `npm install`
- `php artisan migrate` для миграций
- `php artisan db:seed` (если нужны сиды)


## Комплект
- Font Awesome 4.7.0 и Foundation Icon Fonts 3 (отключаются оба и добавлены через CSS, а не SCSS, дабы не ждать компиллирования при watch)
- BrowserSync
- DebugBar [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- Локализация [caouecs/laravel-lang](https://github.com/caouecs/Laravel-lang)
- Админ-панель 4.dev [SleepingOwlAdmin](https://github.com/LaravelRUS/SleepingOwlAdmin)
- barryvdh/laravel-ide-helper

## BrowserSync
Включается при `npm run watch`. Администрируется через порт `127.0.0.1:3001`

Для отключения уберите в файле `webpack.mix.js` строку `mix.browserSync('larafound.kit')`.

## DebugBar
Для удаления достаточно удалить зависимость в `config\app.php`.

## Локализация
Для добавления языка нужно:
- подправить файлик `config\app.php` параметр `locales`
- добавить роуты
- поправить посредника `app\Http\Middleware\Locale.php`
- перевести файлы из уже имеющегося языка

## SleepingOwlAdmin (35292cf)
Вход в админ-панель только админам по адресу `/admin` (можно переназначить в настройках).

Демо можно посмотреть [тут](http://demo.sleepingowladmin.ru/).

[Вопросы по админке](https://gitter.im/LaravelRUS/SleepingOwlAdmin).

За админку огромное спасибо [Дейву](https://github.com/aios)

## Flex, обычная сетка и XY Grid
В связи с переходом на 6.4 и появлением новой респонсивной сисемы верстки добавилась возможность "Все в одном".
Верстайте хоть Flex, хоть старой системой (через row и column/s), хоть XY-разметкой.
Если нужно выключить обычную разметку, нужно раскоментировать строчку `@include foundation-everything(true);` в файле `resurses\assets\sass\app.scss`. Соответственно строчку `@include foundation-everything(false);` нужно закомментировать или удалить.

## Добавлено
- Seeds (admin:admin111 - Администратор; user:user111 - Пользователь)
- Регистрация переделана на Ajax (логин, регистрация, +восстановление пароля уходит, -смена пароля)
- Двухфакторная регистрация (Подтверждение почты по токену)
- Добавлен запрос IP при регистрации пользователя и -верификации почты
- Роли (очень просто - админ, юзер, менеджер)
- База для статических текстов (multi)
- Новостные категории и новости (multi)
- Шаблоны для отображения новостей (-пока в разработке)

## Прочая информация
- На логаут наложено обновление страницы
- Ограничение логина и регистрации до 5 штук в минуту (через роуты и посредника. Кол-во меняется в роутах)

## В планах
- Invisible reCAPTCHA на регистрацию
- Соц реги от laravel/socialite (ФБ, ВК, Гугл, LinkedIn, GitHub, Twitter, Instagram, OK, MailRu, Яндекс)
- Бложик (в процессе)
- Меню во фронт
- Добавить языков (+RU, EN, DE, IT, FR)
- Профайлы и страницу редактирования (CRUD профайла юзера из фронтенда с подключением/отключением социалок к акку)

## Обновление
Последнее обновление сделано 25-09-2017.
- Работоспособность фронта - проверена.
- Работоспособность админки - проверена.

## Вопросы
- [Чатик](https://gitter.im/ZURB-Foundation/Lobby).
- skype: neodaan
- почта daan@ukr.net
- telegram @neodaan

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
