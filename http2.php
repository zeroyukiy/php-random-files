<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        h2 {
            color: black;
        }
    </style>
<!--    <link rel="stylesheet" href="assets/css/style.css" as="style">-->
<!--    <link rel="stylesheet" href="assets/css/style2.css" as="style">-->
<!--    <link rel="stylesheet" href="assets/css/style3.css" as="style">-->
</head>
<body>
    <h2>Hello</h2>
</body>
</html>

<?php

require_once 'vendor/autoload.php';

use Melbahja\Http2\Pusher;

$pusher = Pusher::getInstance();

$pusher->link('assets/css/style2.css')->link('assets/css/style.css')->link('assets/css/style3.css');
$pusher->src('assets/js/hey.js');

$pusher->push();