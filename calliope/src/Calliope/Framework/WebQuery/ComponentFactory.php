<?php
namespace Calliope\Framework\WebQuery;

use Clio\Component\Util\Factory\AliasedComponentFactory;

/**
 * ComponentFactory 
 * 
 * @uses AliasedComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentFactory extends AliasedComponentFactory 
{
	/**
	 * create 
	 * 
	 * @param array $classes 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function create(array $classes = array())
	{
		return new static(array_merge(array(
			'parser' => 'Calliope\Framework\WebQuery\Parser\Parser',
			'builder' => 'Calliope\Framework\WebQuery\Builder\QueryBuilder',
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

