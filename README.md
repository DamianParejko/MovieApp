# Laravel 8.0 - Movie App

This is a website with videos that a logged in user can comment on and rate.

Beside Laravel, this project uses other tools like:

- *Bootstrap 4*
- *Vue.js*
- *Axios*
- *Livewire*

# Requirements 

- *PHP*
- *Composer*
- *NPM*

# Installation && Runnig

**Step 1 - Installation**

Begin by cloning this repository to your machine, and installing all Composer & NPM dependencies.

 `$ git clone https://github.com/DamianParejko/Movie_app`  
 `$ cd Movie_app`  
 `$ composer install && npm install`  
 `$ npm run dev`  

**Step 2 - Running**

Create all the appropriate dependencies to run the project.

`$ create file copy .env.example as file .env`  
`$ run in terminal php artisan key:generate`  
`$ create db_database`  
`$ run in terminal php artisan migrate`  

Now you can access the application via http://localhost:8000.
