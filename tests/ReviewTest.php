<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Review.php";
    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

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
            $cuisine_id = 2;
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
            $cuisine_id = 2;
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
            $cuisine_id = 2;
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
            $cuisine_id = 2;
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

        function test_getRestaurantId()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = 2;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Tasty";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            //Act
            $result = $test_review->getRestaurantId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }


        function test_getAll()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = 2;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Tasty";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            $review_content2 = "Icky";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($id, $review_content2, $restaurant_id);
            $test_review2->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test_review, $test_review2], $result);
        }

        function test_save()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = 2;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Tasty";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);

            //Act
            $test_review->save();

            //Assert
            $result = Review::getAll();
            $this->assertEquals($test_review, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = 2;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Tasty";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            $review_content2 = "Icky";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($id, $review_content2, $restaurant_id);
            $test_review2->save();

            //Act
            Review::deleteAll();

            //Assert
            $result = Review::getAll();
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $restaurant_name = "Pizza";
            $id = null;
            $cuisine_id = 2;
            $test_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_restaurant->save();

            $review_content = "Tasty";
            $restaurant_id = $test_restaurant->getId();
            $test_review = new Review($id, $review_content, $restaurant_id);
            $test_review->save();

            $review_content2 = "Icky";
            $restaurant_id = $test_restaurant->getId();
            $test_review2 = new Review($id, $review_content2, $restaurant_id);
            $test_review2->save();

            //Act
            $result = Review::find($test_review->getId());

            //Assert
            $this->assertEquals($test_review, $result);
        }


    }


?>
