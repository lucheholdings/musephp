<?php
namespace Clio\Component\Util\Accessor\Tests\Models;

class AccessorTestModel
{
	public $foo = 'Foo';

	protected $bar = null;

	private $hoge = false;
    
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
    
    public function getHoge()
    {
        return $this->hoge;
    }
    
    public function setHoge($hoge)
    {
        $this->hoge = $hoge;
        return $this;
    }
}

