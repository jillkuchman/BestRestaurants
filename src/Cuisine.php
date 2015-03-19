<?php

    class Cuisine
    {
        private $food_type;
        private $id;

        function __construct($food_type, $id = null)
        {
            if($id !== null) {
                $this->id = $id;
            }
            $this->food_type = $food_type;
        }

        function setFoodType($new_food_type)
        {
            $this->food_type = (string) $new_food_type;
        }

        function getFoodType()
        {
            return $this->food_type;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $cuisines = array();
            foreach($returned_cuisines as $cuisine) {
                $food_type = $cuisine['food_type'];
                $id = $cuisine['id'];
                $new_cuisine = new Cuisine($food_type, $id);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        function getRestaurants()
        {
            $restaurants = array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT*FROM restaurants WHERE cuisine_id = {$this->getId()};");
            foreach($returned_restaurants as $restaurant) {
                $restaurant_name = $restaurant['restaurant_name'];
                $id = $restaurant['id'];
                $cuisine_id = $restaurant['cuisine_id'];
                $new_restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO cuisines (food_type) VALUES ('{$this->getFoodType()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines *;");
        }

        static function find ($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach ($cuisines as $cuisine)
            {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id)
                {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;

        }

        function updateType($new_food_type)
        {
            $GLOBALS['DB']->exec("UPDATE cuisines SET food_type = '{$new_food_type}' WHERE id = {$this->getId()};");
            $this->setFoodType($new_food_type);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id={$this->getId()};");
        }

    }

?>
