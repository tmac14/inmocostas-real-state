symfony console doctrine:schema:drop -n -q --force --full-database
timeout /t 3
cd migrations
del *.php
timeout /t 3
cd ..
symfony console make:migration
symfony console doctrine:migrations:migrate -n -q
symfony console doctrine:fixtures:load -n -q