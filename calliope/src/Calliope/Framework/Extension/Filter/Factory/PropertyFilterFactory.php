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
		if(!isset($options['field'])) {
			throw new \InvalidArgumentException('PropertyFilterFactory requires "field" on options.');
		}

		if(!isset($options['value'])) {
			throw new \InvalidArgumentException('PropertyFilterFactory requires "value" on options.');
		}

		return new PropertyFilter($options['key'], $options['value'], isset($options['readonly']) ? true : false, isset($options['setter']) ? $options['setter'] : null);
	}
}

