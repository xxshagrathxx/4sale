## General Information
<p align="center">
    I did include the .env file on purpose to facilitate the testing process.
</p>

## Run the app
<p align="center">
    - Use "docker-compose up -d" to run the container.
    <br>
    - Use "docker-compose exec app php artisan migrate" to run the migrations.
    <br>
    - Use "docker-compose exec app php artisan migrate --env=testing" to run the migrations to the test database.
    <br>
    - Use "docker-compose exec app php artisan test" to run the tests.
</p>

## The End Point
<p align="center">
    I included a file named "4sale.postman_collection.json" in the root directory of the project to use the end point with filters in postman to boost the process of testing.
</p>