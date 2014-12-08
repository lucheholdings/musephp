<?php
namespace Calliope\Core\Filter\Factory;

use Clio\Component\Pattern\Factory\PriorityCollection;
use Calliope\Core\Filter\ChainedFilter;

/**
 * ChainedFilterFactory 
 * 
 * @uses PriorityCollection
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ChainedFilterFactory extends PriorityCollection 
{
	/**
	 * createChainedFilter 
	 * 
	 * @access public
	 * @return void
	 */
	public function createChainedFilter()
	{
		return $this->createChainedFilterArgs(func_get_args());
	}

	public function createChainedFilterArgs(array $args = array())
	{
		$options = $this->shiftArg($args, 'options');

		// Get sorted factories
		$factories = $this->getValues();
		// reverse the factories
		rsort($factories);

		$filter = null;
		foreach($factories as $factory) {
			$temp = $factory->createFilter($options);
			if(($filter)) {
				if (!$temp instanceof ChainedFilter) 
					throw new \RuntimeException('Filter has to be chained, but non ChainedFilter instance is passed');
				$temp->setChain($filter);
			}
			$filter = $temp;
		}

		return $filter;
	}
}

