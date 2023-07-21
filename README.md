# task-management-api

This is cookie bases Task Management system. so, you need to server run with same ip address.

Laravel Project

Fist clone the project

```sh
git clone https://github.com/amdad121/task-management-api.git
```

then go to project directory

```sh
cd task-management-api
```

and run

```sh
composer install
```

you need to copy .env.example to .env

```sh
cp .env.example .env
```

After that you need SMTP & Database setup on .env file

then you run this command

```sh
php artisan migrate --seed
```

then you run this command

```sh
php artisan serve
```

now go to run Vue project
