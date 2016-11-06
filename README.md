About this project
===

This project is a ticketing system for the Louvre museum. The situation is purely *fictional*.<br/>

Entirely made with the **[Symfony framework](https://symfony.com/)**, it handles the process of ordering from start to finish, following a specific business model.<br/>
You can read more about the constraints and the context [here](https://openclassrooms.com/courses/projet-developpez-un-back-end-pour-un-client).


[![SensioLabsInsight](https://insight.sensiolabs.com/projects/8bee5ead-5fdd-4073-aa69-16c00bc01527/big.png)](https://insight.sensiolabs.com/projects/8bee5ead-5fdd-4073-aa69-16c00bc01527)

Libraries used :
----------------

- Bootstrap v3
- jQuery
- jQuery UI
- jQuery Payment (*client-side credit card formatting*)
- Stripe API

Test instructions :
-------------------
 
 If you didn't do it already, run composer to download the dependencies :
 
 `composer install` (in "composer.json" 's directory)
 
 If database "*symfony*" already exists, drop it :
  
  `php bin/console doctrine:database:drop --force`
  
  Else, create it : 
  
  `php bin/console doctrine:database:create`
  
  Then, type these instructions :
  
  `php bin/console doctrine:migrations:migrate`
  
  `php bin/console doctrine:fixtures:load --fixtures=src/AppBundle/DataFixtures/ORM/tests`
  
  Congratulations ! Now you can execute all the tests at once by typing `phpunit` in the console.
  
  Or, if you want to run a *specific* test such as "TarifResolverTest" :
  
  `phpunit tests/AppBundle/Service/TarifResolverTest.php`
