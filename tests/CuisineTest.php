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
        protected function tearDown()
        {
            Cuisine::deleteAll();
        }
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

        function test_setFoodType()
        {
            //Arrange
            $food_type = "Soup";
            $id = null;
            $test_Cuisine = new Cuisine($food_type, $id);
            $test_Cuisine->save();

            //Act
            $test_Cuisine->setFoodType("Bread");

            $result = $test_Cuisine->getFoodType();

            //Assert
            $this->assertEquals($result, "Bread");
        }

        function test_getId()
        {
            //Arrange
            $food_type = "Pizza";
            $id = 1;
            $test_Cuisine = new Cuisine($food_type, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_setId()
        {
            //Arrange
            $food_type = "Mexican";
            $id = null;
            $test_Cuisine = new Cuisine($food_type, $id);

            //Act
            $test_Cuisine->setId(2);
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(2, $result);
        }

        function test_getAll()
        {
            //Arrange
            $food_type1 = "Mexican";
            $id1 = null;
            $food_type2 = "Pizza";
            $id2 = null;
            $test_Cuisine1 = new Cuisine($food_type1, $id1);
            $test_Cuisine1->save();
            $test_Cuisine2 = new Cuisine($food_type2, $id2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine1, $test_Cuisine2], $result);
        }

        function test_save()
        {
            //Arrange
            $food_type = "Food truck";
            $id = null;
            $test_Cuisine = new Cuisine($food_type, $id);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $food_type1 = "Mexican";
            $id1 = null;
            $food_type2 = "Pizza";
            $id2 = null;
            $test_Cuisine1 = new Cuisine($food_type1, $id1);
            $test_Cuisine1->save();
            $test_Cuisine2 = new Cuisine($food_type2, $id2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $food = "Noodle";
            $id = 1;
            $food2 = "Soup";
            $id2=2;
            $test_Cuisine = new Cuisine($food, $id);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($food2, $id2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function test_updateType()
        {
            //Arrange
            $food_type = "Japanese";
            $id = 1;
            $test_cuisine = new Cuisine ($food_type, $id);
            $test_cuisine->save();

            $new_food_type = "Chinese";

            //Act
            $test_cuisine->updateType($new_food_type);

            //Assert
            $this->assertEquals("Chinese", $test_cuisine->getFoodType());

        }

        function testDeleteCusine()
        {
            //Arrange
            $cuisine = "Prime Steak";
            $id = 1;
            $test_cuisine = new Cuisine($cuisine, $id);
            $test_cuisine->save();

            $cuisine2 = "Lobster";
            $id2=2;
            $test_cuisine2 = new Cuisine($cuisine2, $id2);
            $test_cuisine2->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([$test_cuisine2], Cuisine::getAll());
        }

        function testDeleteCuisineTypeFromRestaurant()
        {
            //Arrang
            $cuisine = "Sea Crab";
            $id = null;
            $test_cuisine = new Cuisine($cuisine, $id);
            $test_cuisine->save();

            $restaurant = "Mom Kitchen";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $restaurant, $cuisine_id);
            $test_restaurant->save();

            //Act
            $test_cuisine->delete();

            //Assert
            $this->assertEquals([], Restaurant::getAll());
        }

    }



?>
