<?php
namespace Calliope\Core\Filter\Factory;

use Calliope\Core\Filter\Factory;
use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * ConnectionFilterFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConnectionFilterFactory extends ComponentFactory implements Factory
{
	public function __construct()
	{
		parent::__construct(new \ReflectionClass('Calliope\Core\Filter\ConnectionFilter'));
	}

	public function createFilter()
	{
		return $this->createFilterArgs(func_get_args());
	}

	public function createFilterArgs(array $options = array())
	{
		return $this->createComponentArgs(array());
	}
}

