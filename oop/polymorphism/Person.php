<?php

abstract class Person implements Greeting
{
    abstract public function greet(): string;
}