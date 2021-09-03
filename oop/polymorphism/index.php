<?php

require_once 'Greeting.php';
require_once 'Person.php';
require_once 'English.php';
require_once 'German.php';
require_once 'Italian.php';

function greeting(array $people): void
{
    foreach ($people as $person) {
        echo $person->greet() . '<br/>';
    }
}

$people = [
    new English(),
    new German(),
    new Italian(),
];

greeting($people);

trait FileLogger
{
    public function log(string $msg): void
    {
        echo 'File Logger ' . date('Y-m-d h:i:s') . ':' . $msg . '<br/>';
    }
}

trait DatabaseLogger
{
    public function log(string $msg): void
    {
        echo 'Database Logger ' . date('Y-m-d h:i:s') . ':' . $msg . '<br/>';
    }
}

class Logger
{
    use FileLogger, DatabaseLogger {
        DatabaseLogger::log as dbLogger;
        FileLogger::log insteadof DatabaseLogger;
    }
}

$logger = new Logger();
$logger->log('something useful');
$logger->dbLogger('something useful to save');
