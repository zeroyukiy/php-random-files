<?php

function echo_friendly(string $str)
{
    echo '<pre>';
    echo $str;
    echo '</pre>';
}

// strlen() function returns the length of a specified string.
$str = 'PHP';
echo_friendly(strlen($str));

// using strlen() with multibyte string
$str = 'こんにちは';
echo_friendly(strlen($str)); // 15 bytes
echo_friendly(mb_strlen($str)); // 5 characters

// substr() function accepts a string and returns a substring from the string.
$s = 'PHP substring';
$result = substr($s, 0, 3);
echo_friendly($result); // PHP

$result = substr($s, 4);
echo_friendly($result); // substring

$s = 'PHP is cool';
$result = substr($s, -4);
echo_friendly($result); // cool

$result = substr($s, -7, -5);
echo_friendly($result); // is

$s = 'ciao a tutti';
echo_friendly(mb_substr($s, 7, 5, 'UTF8'));

// strpos() function returns the index of the first occurrence of a substring within a string.
$str = 'To do or not to do';
$position = strpos($str, 'do');
echo_friendly($position);

$position = strpos($str, 'To');

if ($position !== false) {
    echo_friendly($position);
} else {
    echo_friendly('not found');
}

// stripos is case-insensitive
$position = stripos($str, 'to');
echo_friendly($position);

// str_replace() function returns a new string with all occurrences of a substring replaced with another string.
// str_replace(array|string $search, array|string $replace, string|array $subject, int &$count = null): string|array
$str = 'Hello there';
$new_str = str_replace('Hello', 'Hi', $str, $count);
echo_friendly($new_str);
echo_friendly($count);

$str = 'The quick brown fox jumps over the lazy dog';
$animals = ['fox', 'dog'];
$new_animals = ['wolf', 'cat'];
$new_str = str_replace($animals, $new_animals, $str, $count);
echo_friendly('string: ' . $new_str . ' changed ' . $count . ' words');

// str_ireplace() same of str_replace() but case-insensitive
$str = 'The World';
echo_friendly(
    str_ireplace('the', 'THE', $str)
);

// implode() or join() function allows you to join an array of strings by a selector.
$columns = ['first_name', 'last_name', 'email'];
$header = implode(',', $columns);
echo_friendly($header);

$header = implode(',', array_map(fn ($column) => str_replace('_', ' ', $column), $columns));
echo_friendly($header);

$columns = ['ssn', 'first_name', 'last_name', 'password', 'email', 'phone'];
$excludes = ['ssn', 'password'];

$header = implode(',', array_filter($columns, fn ($column) => !in_array($column, $excludes)));
echo_friendly($header);

$person = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    25,
    'Wow',
];
echo_friendly(implode('-', $person));

// explode() function returns an array of strings by splitting a string by a separator
$str = 'first_name,last_name,email,phone';
$headers = explode(',', $str);
echo '<pre>';
print_r($headers);
echo '</pre>';

$headers = explode(',', $str, 3);
echo '<pre>';
print_r($headers);
echo '</pre>';

$headers = explode(',', $str, -1);
echo '<pre>';
print_r($headers);
echo '</pre>';

function str_after(string $str, string $search): string {
    return $search === '' ? $str : array_reverse(explode($search, $str, 2))[0];
}
echo_friendly(str_after('john.doe@phptutorial.net', '@'));

// trim() function removes the whitespaces or other characters from the beginning and end of a string
// rtrim() - ltrim()
$str = ' PHP ';
echo_friendly(trim($str));

$uri = $_SERVER['REQUEST_URI'];
echo_friendly('from ' . $uri . ' to ' . trim($uri, '/'));

// htmlspecialchars() function converts special characters into HTML entities
// prevent XSS attacks (XSS stands for cross-site scripting)
$comment = "<script>alert('hello there');</script>";
echo_friendly(htmlspecialchars($comment));

// str_contains() function checks if a string contains a substring.
// is case-sensitive
$haystack = 'PHP is cool.';
$needle = 'PHP';
$result = str_contains($haystack, $needle) ? 'is' : 'is not';
echo_friendly("The string {$needle} {$result} in the sentence.");

// str_starts_with() function performs a case-sensitive search and checks if a string starts with a substring
$str = 'PHP tutorial';
$substr = 'P';
$result = str_starts_with($str, $substr) ? 'is' : 'is not';
echo_friendly("The $str $result starting with $substr");

// str_ends_with() function performs a case-sensitive search and checks if a string ends with a substring
$substr = 'al';
$result = str_ends_with($str, $substr) ? 'is' : 'is not';
echo_friendly("The $str $result ending with $substr");

// strtolower()
$str = "The world IS here";
echo_friendly(strtolower($str));
// strtoupper()
echo_friendly(strtoupper($str));

$arr = ['john'];
//echo_friendly(array_unshift($arr, 'sdasd'));

echo_friendly(call_user_func_array('strlen', $arr));