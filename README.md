# symfony_cvs_import

git clone https://github.com/fantTom/symfony_csv_import.git

cd to directory

composer update

check config to database (app/confug/parameters.yml)

php app/console doctrine:migrations:migrate 

php app/console csv:import test

or

php app/console csv:import 

