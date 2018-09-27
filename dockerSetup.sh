docker exec -it webApi /bin/bash -c "composer install -n -d /var/www/src";
docker exec -it webApi /bin/bash -c "./src/init --env=Development --overwrite=All";
docker exec -it webApi /bin/bash -c "./src/yii migrate --interactive=0";
