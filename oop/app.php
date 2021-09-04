<?php

// singleton pattern
class App
{
    private static ?App $app = null;

    private function __construct()
    {
    }

    public static function get(): self
    {
        if (!self::$app) {
            self::$app = new self();
        }

        return self::$app;
    }

    public function bootstrap(): void
    {
        echo 'App is bootstrapping';
    }
}

$app = App::get();
$app->bootstrap();

echo '<br/>';

class Foo
{
    protected static int $bar = 1234;

    protected function hello(): void
    {
        echo 'hello_Foo <br/>';
    }

    public static function get(): void
    {
        echo static::class . ' ' . static::$bar . '<br/>';
    }

    public function getHello(): void
    {
        static::hello();
    }
}

class Bar extends Foo
{
    protected static int $bar = 4321;

    protected function hello(): void
    {
        echo 'hello_Bar <br/>';
    }
}

class Zap extends Bar
{
    protected static int $bar = 5555;
}

Foo::get();
$foo = new Foo();
$foo->getHello();

Bar::get();
$bar = new Bar();
$bar->getHello();

Zap::get();
$zap = new Zap();
$zap->getHello();


//class A {
//    private function foo() {
//        echo "success!\n";
//    }
//    public function test() {
//        $this->foo();
//        static::foo();
//    }
//}
//
//class B extends A {
//    /* foo() will be copied to B, hence its scope will still be A and
//     * the call be successful */
//}
//
//class C extends A {
//    private function foo() {
//        /* original method is replaced; the scope of the new one is C */
//    }
//}
//
//$b = new B();
//$b->test();
//$c = new C();
//$c->test();   //fails