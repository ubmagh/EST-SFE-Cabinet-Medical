
<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


### this Application is built using Laravel 6.x

## Quick run ; 

* run docker compose up on `compose.yaml`

# About: 

This project is about a web application that manages Medical rooms, it offers a lot of features, like : 
    
    -   many users : Medics and secretaries.
	-   Sms notify patients
	-   documents printing
	-    and other....

-> get logins & passwords from seeders ! 

# Installation:
	
 - After Clonning the App use :  <code>  $ composer install </code>  to download all dependencies
 - Edit the <code>  .env </code> file, configuring you Diskname, Nexmo and Database credentiels.
 - Migrate to database using : <code>  $ php artisan migrate  </code>
 - Generate your secret token using <code> $ php artisan key:generate </code>
 - if you want some temporary/test data use :  <code> $ php artisan db:seed </code> to fill the Database with it.
 - now you can run the app using  <code> $ php artisan serve </code>
 - the credentiels are stored in Migration and seed 's  files.

