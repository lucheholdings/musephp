<?php
namespace Clio\Component\Util\Query;

use Clio\Component\Pattern\Factory\TypedComponentFactory;

/**
 * ComponentFactory 
 * 
 * @uses AliasedComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentFactory extends TypedComponentFactory
{
	/**
	 * create 
	 * 
	 * @param array $classes 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createFactory(array $classes = array())
	{
		return new static(array_merge(array(
			'parser' => 'Clio\Component\Util\Query\Parser\Parser',
			'builder' => 'Clio\Component\Util\Query\Builder\QueryBuilder',
		), $classes));
	}

	/**
	 * createBuilder 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createBuilder(LiteralSet $literals)
	{
		return $this->createByAlias('builder', array($literals));
	}

	/**
	 * createParser 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createParser(LiteralSet $literals)
	{
		return $this->createByAlias('parser', array($literals));
	}
}

