<?php

require_once '../vendor/autoload.php';

use Zeroyukiy\Prova\Database;
use Zeroyukiy\Prova\CustomController;

$db = new Database(['db' => 'bookdb']);
$db->init();
$pdo = $db->pdo;

$c = new CustomController($pdo);
//$c->create('Robert');

print_($c->show(1));

//$c->edit(2, ['name' => 'Crow']);

print_($c->all());

print_($c->multipleSelect([1, 4]));

print_($c->findUsernameByRo('ro') instanceof \Zeroyukiy\Prova\Publisher);
print_($c->findUsernameByRo('ro'));

print_($c->fetchObject(1));

function print_(mixed $str): void
{
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}

print_($_SERVER['REQUEST_URI']);
print_($_SERVER['HTTP_USER_AGENT']);
print_($_SERVER['HTTP_HOST']);
print_($_SERVER['SERVER_ADDR']);
print_($_SERVER['SERVER_PROTOCOL']);
