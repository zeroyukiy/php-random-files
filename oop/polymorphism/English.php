<?php

class English extends Person implements Greeting
{
    public function greet(): string
    {
        return 'Hello';
    }
}