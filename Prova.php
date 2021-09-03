<?php

class Prova implements Stringable
{
    public function __construct(public int $number)
    {
    }

    public function __toString(): string
    {
        return $this->number;
    }
}