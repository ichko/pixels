<?php

class Foo
{
    public function __construct($test)
    {
    }
}

class Bar
{
    public function __construct()
    {
    }
}

$reflection = new ReflectionClass(Foo::class);
$params = $reflection->getConstructor()->getParameters();
foreach ($params as $param) {
    echo $param->name . '<br>';
}

echo is_object('dsa') . '<hr>';
echo is_object(Foo::class) . '<hr>';
echo is_object(new Foo('')) . '<hr>';

class DependencyContainer
{
    private $container = [];

    public function add($dependency)
    {
        $container[$dependency] = new ReflectionClass($dependency);
    }

}
