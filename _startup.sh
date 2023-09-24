#!/bin/bash
echo -e "\033[33mRunning tests...\033[0m"

echo -e "\n\033[36mUsers MS tests\033[0m"
docker exec -it users_ms vendor/bin/phpunit --testdox

echo -e "\n\033[36mNotifications MS tests\033[0m"
docker exec -it notifications_ms vendor/bin/phpunit --testdox

echo ""
echo -e "run '\033[33mdocker exec -it users_ms php artisan simulate:users-endpoint --fake\033[0m' to submit randomly generated user entry"
echo -e "run '\033[33mdocker exec -it users_ms php artisan simulate:users-endpoint <email> <first name> <last name>\033[0m' to submit data maually"
echo -e "run '\033[33mdocker exec -it notifications_ms cat storage/logs/notifications.log\033[0m' to view notifications log"
echo ""
