<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    require_once "src/Review.php";

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants_test');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

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

        function test_setId()
        {
            //Arrange
            $food_type = "Pizza";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Hot Lips Pizza";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            //Act
            $test_restaurant->setId(79);
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(79, $result);
        }

        function test_setRestaurantName()
        {
            //Arrange
            $food_type = "Pizza";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $restaurant_name2 = "Hot Lips Pizza";
            $test_restaurant->setRestaurant($restaurant_name2);


            $test_restaurant->save();

            //$restaurant_name = "Hot Lips Pizza";

            //Act
            $result = $test_restaurant->getRestaurant();

            //Assert
            $this->assertEquals("Hot Lips Pizza", $result);
        }


        function test_setCuisineId()
        {
            //Arrange
            $id = null;

            $food_type = "Breakfast";
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Kitchen";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $test_restaurant->setCuisineId(90);
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(90, $result);
        }

        function test_getCuisineId()
        {
            //Arrange
            $food_type = "Brunch";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Kitchen";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

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
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $restaurant2 = "Sizzle Pie";
            $test_restaurant2 = new Restaurant($id, $restaurant2, $cuisine_id);
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

        function test_deleteAll()
        {
            //Arrange
            $food_type = "Sandwiches";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Pot Belly";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
            $test_restaurant->save();

            $restaurant_name2 = "Honey Hole";
            $test_restaurant2 = new Restaurant($restaurant_name2, $id, $cuisine_id);
            $test_restaurant2->save();

            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $food_type = "Fancy";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $restaurant_name = "Jakes";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $restaurant_name2 = "Finns";
            $test_restaurant2 = new Restaurant($id, $restaurant_name2, $cuisine_id);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::find($test_restaurant->getId());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }


    }


?>
