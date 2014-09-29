<?php
namespace Calliope\Framework\Extension\Filter\Factory;

use Calliope\Framework\Core\Filter\Factory as FilterFactory;
use Calliope\Framework\Extension\Filter\PropertyFilter;

/**
 * PropertyFilterFactory 
 * 
 * @uses FilterFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFilterFactory implements FilterFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFilter(array $options = array())
	{
		if(!isset($options['property'])) {
			throw new \InvalidArgumentException('PropertyFilterFactory requires "property" on options.');
		}

		return new PropertyFilter($options['property']);
	}
}

