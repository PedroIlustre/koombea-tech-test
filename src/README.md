Pre-setup
This project was develop using laravel 7.30.4, laravel/ui 2.5.0 to develop the auth and login implementation,
PHPunit to run some testes and the 7.4.13 version of PHP

To start this project, the user has to run composer install to get all the dependencies that this projetc is using.

To prepare the database it needed to run de create_schema_table.sql file at one database (this one can be found at the root directory of this project), and after that it needed to run the 
comand php artisan migrate:refresh to create all the tables that this application will use.

checkout the .env file to set the right port or right host from where your database is set.

Some .csv file can be found at the root directory of this project.