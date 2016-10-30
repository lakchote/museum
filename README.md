**Test instructions :** 
 
 If you didn't do it already, run composer to download the dependencies :
 
 `composer install` (in "composer.json" 's directory)
 
 If database "*symfony*" already exists, drop it :
  
  `php bin/console doctrine:database:drop --force`
  
  Else, create it : 
  
  `php bin/console doctrine:database:create`
  
  Then, type these instructions :
  
  `php bin/console doctrine:migrations:migrate`
  
  `php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/tests`
  
  ---
  
  **Congratulations !** Now you can execute all the tests at once by typing `phpunit` in the console
  
  If you want to run a *specific* test such as "TarifResolverTest" :
  
  `phpunit tests/AppBundle/Service/TarifResolverTest.php`
  
  