<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Multipurpose Master Laravel 5.8

System Requirements :

- [PHP >= 7.1.3]

How to use

- [open gitbash then cp .env.example .env]
- [do php artisan key:generate]
- [then composer update, after finish do composer dump-autoload]
- [then php artisan config:cache]
- [open .env and you can configure db, username, password as you want]
- [don't forget to create db in mysql / maria db first]

After finishing configuration, you must doing:
- [php artisan config:cache]
- [php artisan cache:clear]
- [php artisan db:seed --class=LaratrustSeeder]
- [php artisan db:seed --class=MenuSeeder]


Username and password:
user : superadministrator
pass : 12345678




