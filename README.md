# symfony_cvs_import

git clone https://github.com/fantTom/symfony_cvs_impor.git

cd to directory

composer update

chech config to database (app/confug/parameters.yml)

php app/console doctrine:migrations:migrate 

php app/console cvs:import test
or
php app/console cvs:import 
