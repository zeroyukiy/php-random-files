<?php

function print_array($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

$arr = array(1, 2, 3, 4, 5);

//unset($arr[1]);

array_push($arr, 7, 8);
array_unshift($arr, 15);
$last_number = array_pop($arr);
echo $last_number;
array_shift($arr);

print_array($arr);

$permissions = [
    'edit',
    'delete',
    'view',
];

array_unshift($permissions, 'create');
print_array($permissions);

$fruits = [
    'banana' => 'yellow',
    'kiwi' => 'green',
    'strawberry' => 'red',
];

$keys = array_keys($fruits);
print_array($keys);

$values = array_values($fruits);
print_array($values);

$result = array_key_exists('banana', $fruits);
echo '<pre>';
var_dump($result);
echo '</pre>';
if ($result) {
    echo "there is a banana.";
}

$result = in_array('yellow', $fruits, true);
var_dump($result);

class Role
{
    public function __construct(public int $id, public string $name)
    {
    }
}

$roles = [
    new Role(1, 'admin'),
    new Role(2, 'moderator'),
    new Role(3, 'user'),
];

// found it, because doesn't check if it is the same instance
if (in_array(new Role(1, 'admin'), $roles)) {
    echo 'found it';
} else {
    echo 'not found it';
}

// Not the same instance
if (in_array(new Role(1, 'admin'), $roles, true)) {
    echo 'found it';
} else {
    echo 'not found it';
}

$result = array_reverse($arr);
print_array($result);

$languages = [
    'PHP',
    'JavaScript',
    'CSS',
    'HTML',
];

$result = array_merge($arr, $languages);
print_array($result);

// spread operator
$numbers = [1, 2, 3, 4, 5];
$scores = [7, 8, ...$numbers];

print_array($scores);

function even_number(): Generator
{
    for ($i = 2; $i < 10; $i += 2) {
        yield $i;
    }
}

$even = even_number();
print_array([...$even]);

class RGB implements IteratorAggregate
{
    private array $colors = ['red', 'green', 'blue'];

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->colors);
    }
}

$rgb = new RGB();

$colors = [...$rgb];
print_array($colors);

// sorting
$employees = [
    'john' => [
        'age' => 24,
        'title' => 'Front-end Developer'
    ],
    'alice' => [
        'age' => 28,
        'title' => 'Web Designer'
    ],
    'bob' => [
        'age' => 25,
        'title' => 'MySQL DBA'
    ]
];
ksort($employees, SORT_STRING);
print_array($employees);

krsort($employees);
print_array($employees);

$numbers = [2, 1, 3, 8, 3, 1, 5];

usort($numbers, function ($x, $y) {
    if ($x === $y) {
        return 0;
    }
    return $x < $y ? -1 : 1;
});
print_array($numbers);

usort($numbers, function ($x, $y) {
    // spaceship operator from php7
    return $x <=> $y;
});
print_array($numbers);

// spaceship operator with arrow function
usort($numbers, fn($x, $y) => $x <=> $y);
print_array($numbers);

// usort to sort an array of names by length
$names = ['Alex', 'Peter', 'John', 'Michael', 'Bob'];
usort($names, fn($x, $y) => strlen($x) <=> strlen($y));
print_array($names);

// usort to sort an array of Person objects by the age property
class Person
{
    public function __construct(public string $name, public int $age)
    {
    }
}

$group = [
    new Person('Bob', 22),
    new Person('Alex', 19),
    new Person('Peter', 32)
];

usort($group, fn(Person $x, Person $y) => $x->age <=> $y->age);
print_array($group);

// static method of class as a callback for the usort function
class PersonComparer
{
    public static function compare(Person $x, Person $y): int
    {
        return $x->age <=> $y->age;
    }
}

usort($group, ['PersonComparer', 'compare']);
print_array($group);

// asort function to sort an associative array and maintain the index association
$mountains = [
    'K2' => 8611,
    'Lhotse' => 8516,
    'Mount Everest' => 8848,
    'Kangchenjunga' => 8586,
];

asort($mountains);
print_array($mountains);

// arsort - reverse order
arsort($mountains);
print_array($mountains);

// uasort function sorts the elements of an associative array with a user-defined comparison function
// and maintains the index association
$countries = [
    'China' => ['gdp' => 12.238, 'gdp_growth' => 6.9],
    'Germany' => ['gdp' => 3.693, 'gdp_growth' => 2.22],
    'Japan' => ['gdp' => 4.872, 'gdp_growth' => 1.71],
    'USA' => ['gdp' => 19.485, 'gdp_growth' => 2.27],
];

// sort the country by GDP
uasort($countries, function (array $x, array $y) {
    return $x['gdp'] <=> $y['gdp'];
});

// show the array
print_array($countries);

// uksort function allows you to sort by key using a user-defined comparison function
$names = [
    'c' => 'Charlie',
    'A' => 'Alex',
    'b' => 'Bob',
];
uksort($names, fn($x, $y) => strtolower($x) <=> strtolower($y));
print_array($names);

// array_map()
$lengths = [10, 20, 30];
$areas = array_map(function (int $length): int {
    return $length * $length;
}, $lengths);
$areas = array_map(
    fn(int $length) => $length * $length,
    $lengths
);
print_array($areas);

// using the php array_map() with an array of objects
class User
{
    public function __construct(
        public int    $id,
        public string $username,
        public string $email)
    {
    }
}

$users = [
    new User(1, 'joe', 'joe@phptutorial.net'),
    new User(2, 'john', 'joe@phptutorial.net'),
    new User(3, 'jane', 'joe@phptutorial.net'),
];
$usernames = array_map(
    fn(User $user) => $user->username,
    $users
);

print_array($usernames);

class Square
{
    public static function area($length): int
    {
        return $length * $length;
    }
}

$lengths = [10, 20, 30];
$areas = array_map('Square::area', $lengths);
print_array($areas);

// using more than one array
$numbers = [1, 2, 3, 4, 5];
$otherNumbers = [7, 11, 16, 32, 78];
print_array(
    array_map(
        fn(int $number, int $otherNumber): int => $number * $otherNumber,
        $numbers,
        $otherNumbers
    )
);

// array_filter()
$numbers = [1, 2, 3, 4, 5];
$odd_numbers = array_filter(
    $numbers,
    function (int $number) {
        return $number % 2 === 1;
    }
);
$odd_numbers = array_filter(
    $numbers,
    fn(int $number) => $number % 2 === 1
);
print_array($odd_numbers);

// using callback as a method of a class
class Odd
{
    public function isOdd($num): bool
    {
        return $num % 2 === 1;
    }
}

$numbers = [1, 34, 11, 16, 17, 18, 199];
$odd_numbers = array_filter(
    $numbers,
    [new Odd, 'isOdd']
);
// otherwise, we can use a static method like so
//$odd_numbers = array_fill(
//    $numbers,
//    'Odd::isOdd'
//);
// ['Odd', 'isOdd']

print_array($odd_numbers);

// if a class implements the __invoke() magic method, you can use it as a callable
class Positive
{
    public function __invoke($number): bool
    {
        return $number > 0;
    }
}

$numbers = [-1, -2, 0, 1, 2, 3, 4, 5];
$positives = array_filter($numbers, new Positive());
print_array($positives);

// passing elements to the callback function.
// sometimes, you want to pass the key, not the value, to the callback function.
$inputs = [
    'first' => 'John',
    'last' => 'Doe',
    'password' => 'secret',
    'email' => 'john.doe@example.com'
];

$filtered = array_filter(
    $inputs,
    fn(string $key): bool => $key !== 'password',
    ARRAY_FILTER_USE_KEY
);
print_array($filtered);

// to pass both the key and value of the element to the callback function, you pass
// the ARRAY_FILTER_USE_BOTH.
$inputs = [
    'first' => 'John',
    'last' => 'Doe',
    'password' => 'secret',
    'email' => ''
];

$filtered = array_filter(
    $inputs,
    fn(string $value, string $key): bool => $value !== '' && $key !== 'password',
    ARRAY_FILTER_USE_BOTH
);
print_array($filtered);

// array_reduce() function reduces an array to a single value using a callback function.
$numbers = [10, 20, 30];
$total = 0;
foreach ($numbers as $number) {
    $total += $number;
}
print_array($total);

$total = array_reduce($numbers, function (?int $previous, int $current): int {
    return $previous + $current;
});
print_array($total);

$carts = [
    ['item' => 'A', 'qty' => 2, 'price' => 10],
    ['item' => 'B', 'qty' => 3, 'price' => 20],
    ['item' => 'C', 'qty' => 5, 'price' => 30]
];

$total = array_reduce(
    $carts,
    fn(int $prev, array $item): int => $prev + $item['qty'] * $item['price'],
    0
);
print_array($total);


