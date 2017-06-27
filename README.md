project
=======

A Symfony 3 project created on June 20, 2017, 6:38 pm.

Authors
--------------

  * Autor

Folders' structure
--------------

 ```
 project/
  ├─ app/
  │  ├─ config/
  │  └─ Resources/
  ├─ bin
  │  └─ console
  ├─ src/
  │  └─ AppBundle/
  ├─ var/
  │  ├─ cache/
  │  ├─ logs/
  │  └─ sessions/
  ├─ tests/
  │  └─ AppBundle/
  ├─ vendor/
  └─ web/
  ```

Running the new instance
--------------

 * run **git clone**
 * run **composer install**
    * setup parameters.yml
 * run **php bin/console doctrine:database:create**
 * run **php bin/console doctrine:schema:create**
 * run **bower install**
 * run **php bin/console cache:clear**
 * run **php bin/console server:run**
 * enjoy


