<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\Factory;

use Calliope\Core\Filter\Factory as FilterFactory;
use Clio\Component\Pattern\Factory;

/**
 * ConnectionFilterFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class EventDispatcherFilterFactory extends Factory\ComponentFactory implements FilterFactory
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

		$options = Factory\Util::shiftArg($args, 'options');

		$eventDispatcher = null;
		if(isset($options['event_dispatcher'])) {
			$eventDispatcher = $options['event_dispatcher'];
		}
		return $this->createComponentArgs(array(null, $eventDispatcher));
	}
}

