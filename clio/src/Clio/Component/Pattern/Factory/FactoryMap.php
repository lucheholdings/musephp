<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Validator\ClassValidator;
/**
 * FactoryMap
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class FactoryMap extends Map implements Factory 
{
	/**
	 * __construct 
	 * 
	 * @param array $factories 
	 * @access public
	 * @return void
	 */
	public function __construct(array $factories = array())
	{
		parent::__construct();

		$this->setValueValidator(new ClassValidator($this->getValidatedFactoryClass()));

		foreach($factories as $key => $factory) {
			if($factory instanceof Factory) {
				$this->set($key, $factory);
			} else {
				$this->set($key, new ComponentFactory($factory));
			}
		}
	}

	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		$args = func_get_args();
		$alias = array_shift($args);
		
		return $this->doCreate($alias, $args);
	}

	/**
	 * createArgs 
	 * 
	 * @param mixed $alias 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createArgs(array $args = array())
	{
		return $this->doCreate($alias, $args);
	}

	/**
	 * createByKeyArgs 
	 * 
	 * @param mixed $alias 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createByKeyArgs($alias, array $args = array())
	{
		return $this->doCreate($alias, $args);
	}

	/**
	 * doCreate 
	 * 
	 * @param mixed $alias 
	 * @param mixed $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate($alias, $args)
	{
		return $this->get($alias)->createArgs($args);
	}

	/**
	 * getValidatedFactoryClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getValidatedFactoryClass()
	{
		return 'Clio\Component\Pattern\Factory\Factory';
	}
}

