<?php

    class Review
    {
        private $id;
        private $review;
        private $restaurant_id;

        function __construct($id=null, $review, $restaurant_id)
        {
            $this->id = $id;
            $this->review = $review;
            $this->restaurant_id = $restaurant_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function setRestaurantId($new_restaurant_id)
        {
            $this->restaurant_id = (int) $new_restaurant_id;
        }

        function setReview($new_review)
        {
            $this->review = (string) $new_review;
        }

        function getReview()
        {
            return $this->review;
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $review_content = $review['review'];
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $new_review = new Review($id, $review_content, $restaurant_id);
                array_push($reviews, $new_review);
            }
            return $reviews;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO reviews (review, restaurant_id) VALUES ('{$this->getReview()}', {$this->getRestaurantId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews *;");
        }

        static function find($search_id)
        {
            $found_reviews = null;
            $reviews = Review::getAll();
            foreach($reviews as $review) {
                $review_id = $review->getId();
                if ($review_id == $search_id) {
                    $found_reviews = $review;
                }
            }
            return $found_reviews;
        }

    }


?>
