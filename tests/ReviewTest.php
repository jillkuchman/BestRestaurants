<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Review.php";
    require_once "src/Restaurant.php";

    $DB = new PDO('pgsql:host=localhost;dbname=restaurants_test');

    class ReviewTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Review::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = null;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Good";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            //Act
            $result = $test_review->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = null;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Good";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            //Act
            $test_review->setId(79);
            $result = $test_review->getId();

            //Assert
            $this->assertEquals(79, $result);
        }

        function test_setReview()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = null;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $review_content2 = "Yummy";
            $test_review->setReview($review_content2);


            $test_review->save();

            //Act
            $result = $test_review->getReview();

            //Assert
            $this->assertEquals("Yummy", $result);
        }


        function test_setRestaurantId()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = null;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            //Act
            $test_review->setRestaurantId(90);
            $result = $test_review->getRestaurantId();

            //Assert
            $this->assertEquals(90, $result);
        }

//already changed test name, but need to change everything else
        // function test_getRestaurantId()
        // {
        //     //Arrange
        //     $food_type = "Brunch";
        //     $id = null;
        //     $test_cuisine = new Cuisine($food_type, $id);
        //     $test_cuisine->save();
        //
        //     $restaurant_name = "Kitchen";
        //     $cuisine_id = $test_cuisine->getId();
        //     $test_restaurant = new Restaurant($restaurant_name, $id, $cuisine_id);
        //     $test_restaurant->save();
        //
        //     //Act
        //     $result = $test_restaurant->getRestaurantId();
        //
        //     //Assert
        //     $this->assertEquals(true, is_numeric($result));
        // }


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
