<?php

require_once "../vendor/autoload.php";

use Doctrine\Common\Collections\ArrayCollection;

class Animal
{
    public function __construct(public string $name, public int $agility)
    {
    }
}

function print_(mixed $m): void
{
    echo '<pre>';
    print_r($m);
    echo '</pre>';
}

$animals = new ArrayCollection([
    new Animal('Tiger', 8),
    new Animal('Cat', 9),
    new Animal('Elephant', 4),
]);
$animals->add(new Animal('Pig', 2));

print_($animals);

$filteredAnimals = $animals->filter(fn($animal) => $animal->agility > 4);

print_($filteredAnimals);

print_($animals->toArray());

$animals2 = $animals->toArray();
foreach ($animals2 as $animal) {
    if ($animal->agility > 4) {
        print_($animal->name);
    }
}

print_($animals->first());

$exists = $animals->exists(fn($key, $animal) => $animal->name === 'Pig');
if ($exists) {
    print_('Pig exists in the animal collection');
}

$collection = new ArrayCollection([1,2,3,4]);
print_($collection);

$collection->next();
$key = $collection->key();
print_($key);

$last = $collection->last();
print_($last);

$mappedCollection = $collection->partition(fn($key, $value) => $value > 1);
print_($mappedCollection);