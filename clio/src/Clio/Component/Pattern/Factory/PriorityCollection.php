<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Util\Container\Set\PrioritySet;
use Clio\Component\Util\Validator\ClassValidator;

/**
 * PriorityCollection 
 *   FactoryCollection supports two type of creation.
 * 
 *   - Create with "isSupportedArgs" guessing.
 *   - Create by Key as MappedFactory
 *
 * @uses Collection
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PriorityCollection extends PrioritySet implements Factory 
{
	/**
	 * initContainer 
	 * 
	 * @param array $values 
	 * @access protected
	 * @return void
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer();

		if(!$this->getStorage() instanceof ValidatableStorage) {
			$this->setStorage(new ValidatableStorage($this->getStorage()));
		}
		$this->setValueValidator(new ClassValidator('Clio\Component\Pattern\Factory\Factory'));
	}

	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		return $this->createArgs(func_get_args());
	}

	/**
	 * createArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createArgs(array $args = array())
	{
		$instance = null;

		// Traverse each factory to create an instance
		foreach($this as $factory) {
			if($factory->isSupportedArgs($args)) {
				return $factory->createArgs($args);
			}
		}

		throw new UnsupportedException('Failed to create an instance. There are no supported factory to create.');
	}

	public function isSupportedArgs(array $args = array())
	{
		foreach($this as $factory) {
			if($factory->isSupportedArgs($args)) {
				return true;
			}
		}
		return false;
	}
}

