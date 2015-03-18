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




?>
