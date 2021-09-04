<?php

require_once 'anonymous.php';

use Pippo\oop\SimpleLogger;

class Logger extends SimpleLogger
{
    public function __construct(bool $verbose)
    {
        parent::__construct($verbose);
    }

    public function log(string $message): void
    {
        echo $this->verbose ? $message . ', hello' : $message;
    }
}

$logger = new Logger(true);
$logger->log("hey");
