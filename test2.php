<?php
/**
 *
 */
class A
{
    public $one = '';
    public $two = '';

    function __construct()
    {
        # code...
    }

    public function echoOne()
    {
        echo $this->one."\n";
    }

    public function echoTwo()
    {
        echo $this->two."\n";
    }
}

$a = new A();

$reflector =new ReflectionClass('A');

$properties = $reflector->getProperties();
$i = 1;

foreach ($properties as $property) {
    $a->{$property->getName()}=$i;
    $a->{"echo".ucfirst($property->getName())}()."\n";
    $i++;
}
exit;
var_dump($properties);exit;
