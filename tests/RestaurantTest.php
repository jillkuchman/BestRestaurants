<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants_test');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Restaurant::deleteAll();
        // }

        function test_getId()
        {
            //Arrange
            $food_type = "Pizza";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Hot Lips Pizza";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            //Arrange
            $food_type = "Pizza";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Hot Lips";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
            $test_restaurant->save();

            $restaurant2 = "Sizzle Pie";
            $test_restaurant2 = new Restaurant($restaurant2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function test_save()
        {
            //Arrange
            $food_type = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Mamamamas";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

        // function test_deleteAll()
        // {
        //     //Arrange
        //     $name = "Dog stuff";
        //     $id = null;
        //     $test_category = new Category($name, $id);
        //     $test_category->save();
        //
        //     $description = "Wash the dog";
        //     $category_id = $test_category->getId();
        //     $test_task = new Task($description, $id, $category_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the dog";
        //     $test_task2 = new Task($description2, $id, $category_id);
        //     $test_task2->save();
        //
        //     //Act
        //     Task::deleteAll();
        //
        //     //Assert
        //     $result = Task::getAll();
        //     $this->assertEquals([], $result);
        // }


    }


?>
