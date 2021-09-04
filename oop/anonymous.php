<?php

namespace Pippo\oop;

interface Logger
{
    public function log(string $message): void;
}

$logger = new class implements Logger {
    public function log(string $message): void
    {
        echo '<pre>';
        echo $message;
        echo '</pre>';
    }
};

$logger->log("text");

echo '<pre>';
echo get_class($logger);
echo '</pre>';

function save(Logger $logger)
{
    $logger->log("hello world");
}

save($logger);

abstract class SimpleLogger implements Logger
{
    public function __construct(protected bool $verbose)
    {
    }

    abstract public function log(string $message): void;
}

$logger = new class(true) extends SimpleLogger {
    public function __construct(bool $verbose)
    {
        parent::__construct($verbose);
    }

    public function log(string $message): void
    {
        echo '<pre>';
        if ($this->verbose) {
            echo '#verbose mod active. <br/>';
            echo '[special]: length message ' . strlen($message) . '<br/>';
            echo '[special]: ' . $message;
        } else {
            echo '[default]: ' . $message;
        }
        echo '</pre>';
    }
};

$logger->log("hello from a different world");

