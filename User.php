<?php

require_once 'Position.php';

class User
{
    private  $firstname;
    private  $lastname;
    private  $age;
    private  $position;

    public function __construct(string $firstname, string $lastname, int $age, Position $position)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->position = $position;
    }
}
