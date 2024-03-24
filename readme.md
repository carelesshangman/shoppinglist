## Shopping List Application
A Laravel app

## Requirements:

[PHP >= 8.0](https://www.php.net/downloads.php)

[Composer](https://getcomposer.org/)

[MySQL database server](https://www.mysql.com/)

## Setup:
- Clone Repo (git clone https://github.com/carelesshangman/shoppinglist)
- Install Dependencies (composer install)
- Configure .env
- Create Database & Run Migrations (php artisan migrate)
- Start the Dev Server (php artisan serve)

## .env (default)
DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=[your-database-name]\
DB_USERNAME=[your-database-username]\
DB_PASSWORD=[your-database-password]