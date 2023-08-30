## Task description:

Build a website with a login. The login should only be successful with the login data admin/test. Afterwards you should see an admin area where you can create, change or delete a news article. The news entries should be stored in a database. The change function should write the data live via javascript into the create form. All functions should be provided with a success or error message.


## Requirements

### What can be used?

- PHP (Object Oriented)
- SQL (Database)
- Vanilla JS (Native Javascript)
- jQuery (https://api.jquery.com/)
- HTML
- CSS

### What should not be used?

- No PHP Frameworks
- No other Javascript libraries
- No HTML and/or CSS Frameworks (eg. Bootstrap)
- No CSS preprocessor (eg. Sass)


# Commands

## Start project

``` shell
cp .env.example .env
docker-compose up -d --build
composer install
composer dump-autoload
php migrations -m
```


## Stop project

``` shell
docker-compose down
```