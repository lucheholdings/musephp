<?php
namespace Erato\Core\Tests\Models;

class Model01 implements \ArrayAccess, \IteratorAggregate
{
	private $privateVariable;

	protected $protectedVariable;

	public $publicVariable;
    
    public function getPrivateVariable()
    {
        return $this->privateVariable;
    }
    
    public function setPrivateVariable($privateVariable)
    {
        $this->privateVariable = $privateVariable;
        return $this;
    }
    
    public function getProtectedVariable()
    {
        return $this->protectedVariable;
    }
    
    public function setProtectedVariable($protectedVariable)
    {
        $this->protectedVariable = $protectedVariable;
        return $this;
    }

	public function offsetSet($key, $value)
	{
		switch($key){
		case 'privateVariable':
		case 'protectedVariable':
		case 'publicVariable':
			$this->{$key} = $value;
			break;
		default:
			break;
		}
	}

	public function offsetGet($key)
	{
		switch($key){
		case 'privateVariable':
		case 'protectedVariable':
		case 'publicVariable':
			return $this->{$key};
			break;
		default:
			break;
		}

		return null;
	}

	public function offsetExists($key)
	{
		switch($key){
		case 'privateVariable':
		case 'protectedVariable':
		case 'publicVariable':
			return true;
			break;
		default:
			break;
		}
		return false;
	}

	public function offsetUnset($key)
	{
		switch($key){
		case 'privateVariable':
		case 'protectedVariable':
		case 'publicVariable':
			$this->{$key} = null;
			break;
		default:
			break;
		}
	}

	public function toArray()
	{
		return array(
			'privateVariable' => $this->privateVariable,
			'protectedVariable' => $this->protectedVariable,
			'publicVariable' => $this->publicVariable,
		);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->toArray());
	}
}

