# symfony_cvs_import

<<<<<<< HEAD
git clone https://github.com/fantTom/symfony_csv_impor.git
=======
git clone https://github.com/fantTom/symfony_cvs_impor.git
>>>>>>> 2127af32a100439f4a8250afde895eadeec520ee

cd to directory

composer update

<<<<<<< HEAD
check config to database (app/confug/parameters.yml)

php app/console doctrine:migrations:migrate 

php app/console csv:import test
or
php app/console csv:import 


symfony php bin/phpunit tests/Command/CsvImportCommandTest.php
=======
chech config to database (app/confug/parameters.yml)

 php app/console doctrine:migrations:migrate 

php app/console cvs:import test
php app/console cvs:import 
>>>>>>> 2127af32a100439f4a8250afde895eadeec520ee
