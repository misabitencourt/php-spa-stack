# PHP SPA Stack

My PHP projects boilerplate. 

Its uses [Slim](https://www.slimframework.com) and [Eloquent](https://laravel.com/docs/5.0/eloquent) on backend.

The frontend is written in ES6+ with [Hyperapp](https://hyperapp.js.org/).

The CSS framework chosed was Bootstrap4 with Material Design Skin.

# Installing

## Software requirements

 - Lampp or Xampp Stack (there is a Vagrantfile in the project)
 - Composer
 - NodeJS

## Install

First, install the php dependencies.

```
composer install
```

Then, install the frontend dependencies.

```
npm install
```

Create a Mysql database with project name.

```
CREATE DATABASE salesman;
```

Edit the .env file with your database access.
Now, Use Phinx to migrate the database structure.

```
php vendor/bin/phinx migrate
```


You can use Phinx to run the seed that creates an admin user.
```
php vendor/bin/phinx seed:run -s UserSeed
```


If you want to change the frontend, use npm start to watch ES6+ javascript files and transpile
to old javascript (and run on older browsers)
```
npm start
```


After the javascript changes has done, use the build script to transpile and minimize javascript:
```
npm run build
```
