<?php
namespace Clio\Extra\Tests\Models;

class SchemifierTestModel02 implements \ArrayAccess, \IteratorAggregate
{
	private $foo;

	private $bar;

	public function __construct($foo, $bar)
	{
		$this->foo = $foo;
		$this->bar = $bar;
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

	public function offsetSet($key, $value)
	{
		switch($key) {
		case 'foo':
			$this->foo = $value;
			break;
		case 'bar':
			$this->bar= $value;
			break;
		default:
		}
	}

	public function offsetGet($key)
	{
		switch($key) {
		case 'foo':
			return $this->foo;
			break;
		case 'bar':
			return $this->bar;
			break;
		default:
		}

		return null;
	}

	public function offsetExists($key)
	{
		switch($key) {
		case 'foo':
		case 'bar':
			return true;
			break;
		default:
		}

		return false;
	}

	public function offsetUnset($key)
	{

	}

	public function getIterator()
	{
		return new \ArrayIterator($this->toArray());
	}

	public function toArray()
	{
		return array(
			'foo' => $this->foo,
			'bar' => $this->bar,
		);
	}

}

