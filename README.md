## License

This project based from Laravel framework which is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## How to Use This Project
* Make sure your xampp or wampp already on latest version because this project use Laravel ^8.0 and require PHP ^7.3.0
* Open project folder and run git bash terminal
* Run this following command in bash terminal
    ```javascript
    $ composer install (if error use $ composer update to upgrade to composer 2)
    $ cp .env.example .env
    $ php artisan key:generate
    ```
* setup .env file with your true database name (you need to create your database first in localhost/phpmyadmin then adjust .env file at database section to the name of database that you create in phpmyadmin. After that run migrate command like bellow.
    ```
    $ php artisan migrate --seed
    ```
* Open in browser
