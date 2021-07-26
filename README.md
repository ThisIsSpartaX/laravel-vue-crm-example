# Laravel + Vue.js example users management admin panel

##Sections:
- Departments
  
- Users

##Pages:

- Home Page: /,

- Login: /login (see admin login and password in UsersTableSeeder),

- Dashboard: /admin,

- Users list: /admin/users/,

- User create: /create,

- User view: /admin/users/:id,

- User edit: /admin/users/:id/edit,

- Departments list /admin/departments/,

- Department create: /admin/departments/create,

- Department view: /admin/departments/:id,

- Department delete: /admin/departments/:id/edit,

## Installation

### Install backend

1 Clone project:

`git clone https://github.com/ThisIsSpartaX/laravel-vue-crm-example.git .`

2 Copy .env.example to .env

`cp .env.example .env`

3 Install vendors:

`composer install`

4 Generate APP key

`php artisan key:generate`

5 Create storage simlink

`php artisan storage:link`

6. Create folder for departments images 

`mkdir storage/app/public/logo`

7 Create Database

8 Set database credentials in .env file

9 Create tables:

`php artisan migrate`

10 Fill database

`php artisan db:seed`

11 Create oAutch clients:

`php artisan passport:install`

12 Set OAuth client id 2 in .env file

`PASSWORD_GRAND_CLIENT_ID=2`

13 Copy OAuth secret from client 2 from oauth_clients DB table to .env file
 
`PASSPORT_SECRET=`

### Install frontend

1 Install NPM

`npm install`

2 Compile JavaScript and SCSS

`npm run development` or `npm run production` 

or watch in development mode

`npm run watch

### Project testing

1 Create testing env file

`cp .env.example .env.testing`

2 Fill DB credentials in .env.testing

3 Set OAuth client id 2 in .env.testing file

`PASSWORD_GRAND_CLIENT_ID=2 `

_(PASSPORT_SECRET in .env testing not needed)_

4 Start tests:

`./vendor/bin/phpunit tests/Unit`