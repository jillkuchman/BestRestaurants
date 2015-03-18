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
            
        }

    }

?>
