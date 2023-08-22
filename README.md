## CodeIgniter 4 REST API Integration with JWT
This toolkit is for people who like to build web REST API's with token based structure like JWT using PHP. Its goal is to enable you to develop api much faster than you could if you were writing code from scratch, by providing a template for your workings with the REST API with JWT based tokens.

*********************
**Release Information**
*********************
This repo contains in-development code for future releases.

*********
**Features**
*********

1. Complete REST API control
2. JWT based access tokens
3. CRUD operations
4. Register/Login
5. Proper Authentication
6. Validation control
7. Routing handled

***********
**Setup Instruction**
***********

- Rename `env` to `.env` and tailor for your app.
- Go to the directory where you have `composer.json` and run the following command: `composer install`.
- Change `JWT_SECRET_KEY` & `JWT_TIME_TO_LIVE` according to your need.
- Change `app.baseURL` in .env
- Change DB credentials accordingly in .env
- Create a database with the same name in MySQL.
- Export `db_artikel.sql` to MySQL
- login user email `admin@localhost.com`
- login user password `123456`

> [!TIP]
> Either way, running `install` when a `composer.lock` file is present resolves and installs all dependencies that you listed in `composer.json`, but Composer uses the exact versions listed in `composer.lock` to ensure that the package versions are consistent for everyone working on your project.

*******************
Server Requirements
*******************

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

*******************
References
*******************

- [twilio](https://www.twilio.com/blog/create-secured-restful-api-codeigniter-php)
