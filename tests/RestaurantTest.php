<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurants.php";

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants_test');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        

    }


?>
