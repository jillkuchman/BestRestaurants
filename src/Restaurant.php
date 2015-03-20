<?php

    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;

        function __construct($id=null, $name, $cuisine_id)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = (int) $new_cuisine_id;
        }

        function setRestaurant($new_restaurant)
        {
            $this->name = (string) $new_restaurant;
        }

        function getRestaurant()
        {
            return $this->name;
        }

        static function getAll()
        {
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $restaurants = array();
            foreach($returned_restaurants as $restaurant) {
                $restaurant_name = $restaurant['restaurant_name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function getReviews()
        {
            $reviews = array();

            $returned_reviews = $GLOBALS['DB']->query("SELECT*FROM reviews WHERE restaurant_id={$this->getId()};");
            foreach($returned_reviews as $review)
            {
                $review_content = $review['review'];
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review($id, $review_content, $restaurant_id);
                $review=$new_review->getReview();
                array_push($reviews, $review);
            }
            return $reviews;

        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO restaurants (restaurant_name, cuisine_id) VALUES ('{$this->getRestaurant()}', {$this->getCuisineId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants *;");
        }

        static function find($search_id)
        {
            $found_restaurant = null;
            $restaurants = Restaurant::getAll();
            foreach($restaurants as $restaurant) {
                $restaurant_id = $restaurant->getId();
                if ($restaurant_id == $search_id) {
                    $found_restaurant = $restaurant;
                }
            }
            return $found_restaurant;
        }

    }


?>
