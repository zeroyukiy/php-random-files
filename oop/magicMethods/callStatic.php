<?php

/**
 * @method static upper
 * @method static lower
 * @method static len
 */
class Str
{
    private static array $methods = [
        'upper' => 'strtoupper',
        'lower' => 'strtolower',
        'len' => 'strlen',
    ];

    public static function __callStatic(string $name, array $arguments)
    {
        if (!array_key_exists($name, self::$methods)) {
            throw new Exception('The ' . $name . ' is not supported.');
        }

        return call_user_func_array(self::$methods[$name], $arguments);
    }
}

try {
    echo Str::upper('Hello World') . '<br/>';
    echo Str::lower("Hello World") . '<br/>';
    echo Str::len('Hello World') . '<br/>';
    echo Str::dsfdsf('dfdsfd');
} catch (Exception $ex) {
    echo $ex;
}
