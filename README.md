To start:

$git clone

$ composer install

$ cp .env.example .env

$ php artisan key:generate  

 configure DB in .env file

$ php artisan migrate

$ php artisan seed

# Users:

$ php artisan geomiq:users:list  
or to use the VIEW table for select
$ php artisan geomiq:users:list --view 

Note: Because of missing data the "admin" and "vendor" roles are assigned by user_id!

# Processing 
$ php artisan geomiq:process:input 
(by defoult loads the sring to be processed from hardcoded value)
or to load the string from file
$ php artisan geomiq:process:input --file=/path/to/file.in

# Because of the limited pattern in provided data the solution is not as generic as should be.
[The Regex patter can be extended for "-1.0415681311891685e-16" format!]

also because the time I had to spend is still missin the Unit-test and Integration (Behat) test.
 