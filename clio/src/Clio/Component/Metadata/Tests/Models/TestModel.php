<?php
namespace Clio\Component\Metadata\Tests\Models;

class TestModel
{
	private $foo;

	private $bar;
    
    public function getFoo()
    {
        return $this->foo;
    }
    
    public function setFoo($foo)
    {
        $this->foo = $foo;
        return $this;
    }
    
    public function getBar()
    {
        return $this->bar;
    }
    
    public function setBar($bar)
    {
        $this->bar = $bar;
        return $this;
    }
}
