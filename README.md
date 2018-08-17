# php-contact-form
Code Challenge.

## Information
I decided to go ahead and use Laravel because it's what I'm most comfortable with. I also added a Vue.js component for the actual contact form simply so the page doesn't have to reload when the form is submitted.

## Setup
To get the repo setup, just download or fork the repo, and cd into the project folder. You'll then need to setup an `.env` file like [mine here](https://github.com/A3mercury/php-contact-form/wiki/Environment-file) and change any variables that adhere to your local dev environment. *I realize it's best not to have the `.env` file public, but there's nothing here worth stealing.*

I've used MySQL for the database, but you'll have to create the actual database yourself and add the information for it like the database, username, and password to your `.env` file.

Once your `.env` file is set, you can run a few commands:
```
composer install
php artisan make:database
composer set-database
npm install
npm run production
```

Those should get the project ready to go. `php artisan make:database` is a custom command that should create a new database using the database name in your `.env` file. `composer set-database` is a custom composer command that runs a few commands in a row:
```
composer dump
php artisan migrate:fresh
php artisan migrate
```

I personally use `valet` for local development right now, but you can use whatever you'd like as long as you make sure the `.env` file is setup correctly (but you probably already knew that).

For testing, use `phpunit` or if you're like me you'll have to run `vendor/bin/phpunit` to run the tests.

## Notes:
* You will notice I swapped the order of the 2 processes, emailing guy-smiley@example.com and saving a copy to the database, because I wanted to be able to send the model to the email to make it a bit easier. 
* Instead of `phpunit` I use `vendor/bin/phpunit` to use the project's vendor's phpunit.
* I also have been using `MailHog` to handle sending emails locally in case there are some issues with local configurations, but there shouldn't be.

I've really enjoyed doing this code challenge!
