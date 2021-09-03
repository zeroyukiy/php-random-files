<?php

class German extends Person implements Greeting
{
    public function greet(): string
    {
        return 'Hallo';
    }
}