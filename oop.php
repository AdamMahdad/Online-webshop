<?php

class User {
    public $name;
    public $gender;
    public $age;

    public function __construct() {
        $this->name = "John";
        $this->gender = "male";
        $this->age = 30;
    }

    public function sayHello() {
        
       echo $this->name . " is a " . $this->age . " year old " . $this->gender . "\n";
    }
}

$user1 = new User();
$user1->sayHello();
