<?php

class MyClass
{
    public function __invoke(): void
    {
        echo 'Hi';
    }
}

$instance = new MyClass();
$instance();
echo is_callable($instance) ? 't' : 'f';

class Comparator
{
    public function __construct(private string $key)
    {
    }

    public function __invoke($a, $b): int
    {
        return $a[$this->key] <=> $b[$this->key];
    }
}

$customers = [
    ['id' => 1, 'name' => 'John', 'credit' => 20000],
    ['id' => 3, 'name' => 'Alice', 'credit' => 10000],
    ['id' => 2, 'name' => 'Bob', 'credit' => 15000],
    ['id' => 4, 'name' => 'Elias', 'credit' => 99999],
    ['id' => 6, 'name' => 'Argon', 'credit' => 34000],
];

usort($customers, new Comparator('credit'));
//usort($customers, fn($a,$b) => $a['credit'] < $b['credit'] ? -1 : 1);
echo '<pre>';
print_r($customers);
echo '</pre>';

usort($customers, new Comparator('name'));
echo '<pre>';
print_r($customers);
echo '</pre>';