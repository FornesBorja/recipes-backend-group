# Recipes PHP Laravel Project

This project was made as part of a course Full Stack Developer for GeeksHubs Academy.

## Index 🔍

-   [Assignment](#assignment-)
-   [Stack](#stack)
-   [Database Diagram](#database-diagram)
-   [Local Installation](#local-installation-️)
-   [Endpoints](#endpoints)
-   [Points of Improvement](#points-of-improvement)

## Assignment 📝

GeeksHub gave the assignment to develop a REST API which is capable of the following:

-   User registration
-   User login + token + middleware
-   Middleware for user roles
-   CRUD of the different models

## Stack 💻

<div align="center">

 <a href="">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
</a>
 <a href="">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
</a>
 <a href="">
    <img src="https://img.shields.io/badge/HTML-239120?style=for-the-badge&logo=html5&logoColor=white" alt="HTML" />
</a>
 <a href="">
    <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</a>
<a href="">
    <img src="https://img.shields.io/badge/JWT-000000?style=for-the-badge&logo=jsonwebtokens&logoColor=white" alt="JWT" />
</a>
 </div>

## Database Diagram 📊

This diagram shows the structure of the database tables.

<a href="">
    <img src="https://i.gyazo.com/4f900e41b9c1a976601dd31c733f57ef.png" alt="DB-Diagram" />
</a>

## Local installation 🛠️

1. Clone the repository
   `$ git clone https://github.com/FornesBorja/recipes-backend-group.git`
2. Install the PHP dependencies
   `$ composer install`
3. Copy the file .env.example, change the name to .env and fill in all the fields
4. Generate an application key
   `$ php artisan key:generate`
5. Run the database migrations
   `$ php artisan migrate`
6. Plant the seeds
   `$ php artisan db:seed`
7. Start the development server
   `$ php artisan serve`

## Endpoints ⚙️

You can find all endpoints here: [Postman Endpoints](https://documenter.getpostman.com/view/36919197/2sAXqqbhUj) <br/>
In app > Http > Collections you can find the collection of the endpoint to import into your postman.

## Points of Improvement 💡

Some extra possible functionalities to be added:

-   The option to add images to user profiles and recipes
-   The option to save other peoples recipes
-   The option to view all saved recipes
