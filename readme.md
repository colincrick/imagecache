<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Image Cache

Installation:

- Clone this repository and change directory to the application root.
- Install dependencies: `composer install`.
- Edit database configuration in `.env`  
    eg:  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=imagecache  
    DB_USERNAME=homestead  
    DB_PASSWORD=secret
- Create the database table(s): `php artisan migrate`.

Usage:
- Run the picture importer command: `php artisan import:pictures /path/to/csv/files`.
- Picture files are stored in `storage/pictures` (configurable in `config/app.php`)

Assumptions:

- All csv import files have the same header row as the example file
- All images are `.jpg`  
I know, I know! :)