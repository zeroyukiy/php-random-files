<?php

class Address
{
    public string $street;
    public string $city;
}

class Person
{
    public Address $address;

    public function __construct(public string $name)
    {
        $this->address = new Address();
    }

    // __clone magic method is called after the Person object is cloned
    // it's useful for copy even the reference's properties (deep copy)
    public function __clone(): void
    {
        $this->address = clone $this->address;
    }
}
$john = new Person('John Snow');
$john->address->city = 'Rome';
$john->address->street = 'Via Poli';

// clone a reference type (object)
$francis = clone $john;
// __clone method is called here

// the address is copied too from the magic method, so I finally can change the properties
$francis->name = 'Francis';
$francis->address->city = 'Berlin';
$francis->address->street = 'Marienstraße';

echo '<pre>';
var_dump($john);
var_dump($francis);
echo '</pre>';

// Different approach without clone and __clone
function deep_clone(Object $object) {
    return unserialize(serialize($object));
}

$abdul = new Person('Abdul');
$abdul->address->city = 'London';
$abdul->address->street = '';

$peter = deep_clone($abdul);
$peter->name = 'Peter';
$peter->address->city = 'New York';

echo '<pre>';
var_dump($abdul);
var_dump($peter);
echo '</pre>';
