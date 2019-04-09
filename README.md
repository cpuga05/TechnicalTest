# Uvinum Technical Test
## Requirements
* Composer
* PHP >= 7.1
  * Simplexml extension
## Start project
### Installation
```bash
$ git clone https://github.com/cpuga05/UvinumTechnicalTest.git
$ cd UvinumTechnicalTest
$ composer update
```
### Run tests
```bash
$ vendor/bin/phpunit -c phpunit.xml test/
```
### Run application
```bash
$ php src/Shop/Infrastructure/UI/Console/init.php
```
OR
```bash
$ cd src/Shop/Infrastructure/UI/Console
$ php init.php
```
## In app
When the application is started, you get a menu to interact to do:
* View all products in store
* Take product to cart
* Remove product to cart
* View change currency from total price
## Future changes
* Change the name of the test folder to tests
* Group tests and entities into entities
* Improve tests