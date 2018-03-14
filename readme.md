# Administrator Labs Full project

* ***Environment*** Laravel 5.4, Php 5.6, vagrant, composer, gitlab versioning

* ***Database*** Mysql, Migration and Seeders

* ***Relationships***
One To One,
One To Many

* ***Library external***
consoletvs/charts, league/csv, barryvdh/laravel-dompdf

* ***Other functions***
Policies, Jobs, Exceptions

* ***ScreeShot***

![Larancer screenshot](http://webcoderpro.com/roles-permissions-manager-spatie.png)

## Usage

- Clone the repository with `git clone`
- Copy `.env.example` file to `.env` and edit database credentials there
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate --seed` (it has some seeded data - see below)
- That's it: launch the main URL and login with default credentials `admin@admin.com` - `password`


## License

The [MIT license](http://opensource.org/licenses/MIT).

## Notice

We are not responsible for any functionality or bugs in **AdminLTE**, **Laravel-permission** or **Datatables** packages or their future versions, if you find bugs there - please contact vendors directly.