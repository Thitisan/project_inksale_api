## Build

```bash
-1 $ composer install
-2 .1 edit " DB_DATABASE=_DatabaseName_ " in file .env.example and run xampp
-2.2 $ cp .env.example .env 
-3 $ php artisan key:generate
-4 $ php artisan jwt:secret
-5 $ php artisan migrate:fresh 
create table in database
-6 $ php artisan serve
```
