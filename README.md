## Yassen Petrov interview task
Original assignment:

>Create an application with 2 microservices that communicate via message bus.
>
>
>* Service "users" has an endpoint POST /users and on request with body {"email","firstName","lastName"},
>  stores the submitted data in a database or in a log file.
>
>* When the submitted data is saved, an event is generated and it is sent through a message broker to
>  the "notifications" service. In "notifications" service the event is consumed and the sent data is saved in a log file.
>
>* The code must be covered with tests - unit, integration and functional tests.
>
>* Prepare needed containers in docker.
>
>* Create README file with instructions.
>
>* Upload the code to one repository in Github.
>
>Bonus points if you use DDD or/and CQRS.

### Installation
Clone the repository
```bash
git clone https://github.com/yobsoddoth/ypetrov-nb.git ypetrov-task
```
Run the Docker containers
```bash
cd ypetrov-task
docker-compose up --build
```
### Usage
Run the startup shell script (optional)
```bash
./_startup.sh
```
It will run all the tests for both microservices and give you a list of convinient to copy/paste commands for further manual testing:

* `docker exec -it users_ms php artisan simulate:users-endpoint --fake` to submit randomly generated user entry (uses `fakerphp` library);
* `docker exec -it users_ms php artisan simulate:users-endpoint <email> <first name> <last name>` to submit data maually;
* `docker exec -it notifications_ms cat storage/logs/notifications.log` to view notifications log;

### Architecture
`users_ms` and `notifications_ms` both use `Laravel 10` as a framework. The communication between them happens through `RabbitMQ`.

`users_ms` uses `MariaDB` as a data storage, while `notifications_ms` uses `sqlite`, mostly as a demonstration of variation of tech-stacks between the microservices.

For both microservices the domain functionality if hooked up to the framework by `App\Providers\AppServiceProvider` Laravel class.

`users_ms` dispatches, and `notifications_ms` listens for `\App\Jobs\UserStoredNotificationJob`.