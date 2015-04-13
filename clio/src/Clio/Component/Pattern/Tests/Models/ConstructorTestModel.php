<?php
namespace Clio\Component\Pattern\Tests\Models;

class ConstructorTestModel  
{
    static public function factory($foo)
    {
        return new self($foo);
    }

    public $foo;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }
}

