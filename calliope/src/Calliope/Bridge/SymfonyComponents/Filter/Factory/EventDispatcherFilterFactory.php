<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\Factory;

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
class EventDispatcherFilterFactory extends ComponentFactory implements Factory
{
	public function __construct()
	{
		parent::__construct(new \ReflectionClass('Calliope\Bridge\SymfonyComponents\Filter\EventDispatcherFilter'));
	}

	public function createFilter()
	{
		return $this->createFilterArgs(func_get_args());
	}

	public function createFilterArgs(array $args = array())
	{

		$options = $this->shiftArg($args, 'options');

		$eventDispatcher = null;
		if(isset($options['event_dispatcher'])) {
			$eventDispatcher = $options['event_dispatcher'];
		}
		return $this->createComponentArgs(array(null, $eventDispatcher));
	}
}

