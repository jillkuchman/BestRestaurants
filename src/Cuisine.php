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

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO cuisines (food_type) VALUES ('{$this->getFoodType()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

    }

?>
