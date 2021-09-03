<?php

class Circle
{
    private const PI = M_PI;

    public function __construct(private float $radius)
    {
    }

    public function area(): float
    {
        return self::PI * $this->radius ** 2;
    }
}

$circle = new Circle(10.2);
echo $circle->area() . '<br/>';

abstract class Model
{
    protected const TABLE_NAME = '';

    public static function all(): string
    {
        return 'SELECT * FROM' . ' ' . static::TABLE_NAME . '<br/>';;
    }
}

class User extends Model
{
    protected const TABLE_NAME = 'users';
}

class Role extends Model
{
    protected const TABLE_NAME = 'roles';
}

echo User::all();
echo Role::all();