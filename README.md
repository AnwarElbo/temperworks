# Temper Code Challenge Results

I have completed the challenge within the requirements. I have made the following assumptions:

* The cars will have no specific order.
* The frontend will be a (very) simple HTML form.
* I added Prophecy for mocking in my unit tests.
* I am using the session for saving the state.

The only thing I deviated from was the ~1 hour time limit.
In total, I was ~2 hours busy with the challenge.
The reasoning behind this is, if you want to write good OOP code with tests and in mind that there will be added functionality in the future, 1 hour is just too short for this assignment.

### How to run this program

I've updated the docker-compose.yml to run the buildin php server and forwarded port 9000. Use the following steps to see the program running:

* Start the Docker containers: `docker compose up -d`
* Go to: `http://localhost:9000/index.php`
* You should see the page

To run the unit tests follow the next steps:

* Start the Docker containers: `docker compose up -d`
* Run composer install (for PHPUnit & Prophecy) with: `docker compose exec app composer install`
* Run the tests with: `docker compose exec app vendor/bin/phpunit .`
