<?php
namespace Clio\Component\Util\Execution;

class MethodInvoker extends Invoker 
{
	private $object;

	private $method;

	public function __construct($object, $method)
	{
		$this->object = $object;
		$this->method = $method;
	}

	protected function doInvokeArgs(array $args)
	{
		return call_user_func_array(array($this->object, $this->method), $args);
	}
    
    public function getObject()
    {
        return $this->object;
    }
    
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }
    
    public function getMethod()
    {
        return $this->method;
    }
    
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
}

