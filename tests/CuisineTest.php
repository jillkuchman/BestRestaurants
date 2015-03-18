<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants_test');

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        function test_getFoodType()
        {
            //Arrange
            $food_type = "Pizza";
            $id = null;
            $test_Cuisine = new Cuisine($food_type, $id);

            //Act
            $result = $test_Cuisine->getFoodType();

            //Assert
            $this->assertEquals($food_type, $result);
        }

        function test_getId()
        {
            $food_type = "Pizza";
            $id = 1;
            $test_Cuisine = new Cuisine($food_type, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        // function test_setId()
        // {
        //     //Arrange
        //     $food = "Pizza";
        //     $id = null;
        //     $test_Cuisine = new Cuisine($food, $id);
        //
        //     //Act
        //     $test_Cuisine->setId(2);
        //
        //     //Assert
        //     $result = $test_Cuisine->getId();
        //     $this->assertEquals(2, $result);
        // }

    }



?>
