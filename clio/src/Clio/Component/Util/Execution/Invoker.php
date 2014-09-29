<?php
namespace Clio\Component\Util\Execution;

abstract class Invoker 
{
	public function invoke()
	{
		return $this->doInvokeArgs(func_get_args());
	}
	
	public function invokeArgs(array $args = array())
	{
		return $this->doInvokeArgs($args);
	}

	public function __invoke()
	{
		return $this->doInvokeArgs(func_get_args());
	}

	abstract protected function doInvokeArgs(array $args);
}

