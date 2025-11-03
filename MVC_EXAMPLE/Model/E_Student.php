<?php
    class Student{
        public $ID;
        public $NAME;
        public $AGE;
        public $UNIVERSITY;

        public function __construct($id, $name, $age, $university) {
            $this->ID = $id;
            $this->NAME = $name;
            $this->AGE = $age;
            $this->UNIVERSITY = $university;
        }
    }
?>