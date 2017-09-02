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
 
 Run composer to download the dependencies :
 
 `composer install`
 
  Create the database : 
  
  `php bin/console doctrine:database:create`
  
  Then, type these instructions (it will load entities and fixtures into the database) :
  
  `php bin/console doctrine:migrations:diff`
  
  `php bin/console doctrine:migrations:migrate`
  
  `php bin/console doctrine:fixtures:load`
  
  Now you can execute all the tests at once by typing `phpunit` in the console.
  Or, if you want to run a *specific* test such as "TarifResolverTest" :
  
  `phpunit tests/AppBundle/Service/TarifResolverTest.php`
  
  **Stripe** payment testing 
  --------------------------
  
  Use the following card number : *4242 4242 4242 4242* with any expiration date and CVC.
  
