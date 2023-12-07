# Dev-eval-test

# Setup instructions

- run `git clone ...`

open IDE Project from existing files in this directory
- `cp .env.example .env`
- set DB_PASSWORD in .env
- `docker compose up -d`

Wait until docker build.

- Inside php container
    - run `composer install`
    - make sure that there is no key
    - run `php artisan key:generate`
    - run `php artisan migrate`
    - run `php artisan optimize`

## to open php container
run `docker exec -it dev-eval-php bash`

## to run tests inside container
- run inside container `./vendor/bin/phpunit`

## Frontend part
- run `npm install`
- run `npm run dev`

## API documentation
To get API documentation use "Dev Eval.postman_collection.json" file
