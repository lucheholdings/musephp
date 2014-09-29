<?php
namespace Calliope\Framework\Extension\Filter\Factory;

use Calliope\Framework\Core\Filter\Factory as FilterFactory;
use Calliope\Framework\Extension\Filter\TagFilter;

/**
 * TagFilterFactory 
 * 
 * @uses FilterFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagFilterFactory implements FilterFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFilter(array $options = array())
	{
		if(!isset($options['tags'])) {
			throw new \InvalidArgumentException('TagFilterFactory requires "tags" on options.');
		}

		return new TagFilter($options['tags']);
	}
}

