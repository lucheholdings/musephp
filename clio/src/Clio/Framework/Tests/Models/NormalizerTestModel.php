<?php
namespace Clio\Framework\Tests\Models;

class NormalizerTestModel 
{
	private $foo;

	protected $bar;

	public $hoge;

	public function __construct($foo, $bar, $hoge)
	{
		$this->foo = $foo;
		$this->bar = $bar;
		$this->hoge = $hoge;
	}
    
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

