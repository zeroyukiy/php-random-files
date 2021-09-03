<?php declare(strict_types=1);

/**
 * @method length
 * @method length2
 * @method upper
 * @method lower
 * @method cu
 */
class Str
{
    private array $methods = [
        'length' => 'strlen',
        'length2' => 'custom_strlen',
        'upper' => 'strtoupper',
        'lower' => 'strtolower',
        'cu' => 'custom',
    ];

    public function __construct(private string $str)
    {
    }

    public function __call(string $name, array $arguments)
    {
        if (!in_array($name, array_keys($this->methods))) {
            throw new BadMethodCallException();
        }

        array_unshift($arguments, $this->str);

        return call_user_func_array($this->methods[$name], $arguments);
    }
}

function custom(string $str, int $a, int $b): int
{
    echo 'String passed to the constructor: ' . $str . ', result from custom function -> ';
    // parameters passed to cu() method
    return $a * $b;
}

function custom_strlen(string $str): int
{
    echo 'from custom_strlen function ';
    return strlen($str);
}

$s = new Str('Hello World');

echo '<pre>';
echo $s->cu(10, 2);
echo '<br/>';
echo $s->length2();
echo '<br/>';
echo $s->upper();
echo '<br/>';
echo $s->length();
echo '<br/>';
echo $s->lower();
echo '</pre>';
