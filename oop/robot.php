<?php

class Robot
{
    public function greet(): string
    {
        return 'Hello!';
    }
}

class Android extends Robot
{
    public function greet(): string
    {
        $greetings = parent::greet();
        return $greetings . ' Hi';
    }
}

$robot = new Robot;
echo $robot->greet();

$android = new Android();
echo $android->greet();