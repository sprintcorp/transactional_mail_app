# Getting started

## Brief description

The minisend is a transactional email application that allows users to send emails to users emails and provides sender with status of the action performed.
Transactional emails are mails that helps informs users on status of action performed, e.g mails users get upon purchase of items can be classified as a transactional mail. 

## Features
- Send Email
- View Emails for a specific recipient
- View Email information
- Resend failed email
- View emails with pagination and search

## Tools
- PHP 8
- Laravel framework
- Vue Js framework
- mysql
- Bootstrap

## Login details

Application is not authenticated neither is authorization required

## Installation

Please check the official laravel installation guide for server requirements before you start. 
[Official Documentation](https://laravel.com/docs/9.x/installation)


Clone the repository

    git clone https://github.com/sprintcorp/transactional_mail_app.git

Switch to the folder directory

    cd transactional_mail_app

Install all the serverside dependencies using composer manager

    composer install

Install all the client side dependencies using node package manager

    npm install

Copy the example env files and make the required configuration changes (database, queues and smtp connection)

    cp .env.example .env


Generate a new application key

    php artisan key:generate

Create database on local machine and set credentials to .env

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Populate the database with seed data with relationships which includes emails, statuses, attachments, etc

    php artisan db:seed

Start the local development server

    php artisan serve

Start the frontend

    npm run hot

You can now access the server at http://127.0.0.1:8000

Running The Queue Worker for sending emails

    php artisan queue:work

To run test use the command below

    php artisan test



