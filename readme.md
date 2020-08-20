<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Getting started

# laravel-repositories-adminlte
Project Laravel Repositories with AdminLte

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/6.0/installation#installation)


Clone the repository

    git clone https://github.com/rodineiti/laravel-repositories-adminlte.git

Switch to the repo folder

    cd laravel-repositories-adminlte

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env
    
Set Database SQLITE in .env

    DB_CONNECTION=sqlite

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


![image](https://user-images.githubusercontent.com/25492122/90826778-71b72a80-e311-11ea-9b50-c6879097c144.png)


![image](https://user-images.githubusercontent.com/25492122/90826862-8e536280-e311-11ea-9f49-36377d302b47.png)
