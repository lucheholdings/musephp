<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Util\Container\Set\PrioritySet;
use Clio\Component\Util\Container\Storage\ValidatableStorage;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * PriorityFactoryCollection 
 *   PrioirtyFactoryCollection is a factory collection which create with highest priority factory of argument supported
 *   PriorityFactoryCollection create with "create" or "createArgs" factory method.
 * 
 * @uses Collection
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PriorityFactoryCollection extends PrioritySet implements Factory 
{
	/**
	 * initContainer 
	 * 
	 * @param array $values 
	 * @access protected
	 * @return void
	 */
	protected function initContainer(array $values = array())
	{
		parent::initContainer($values);

		if(!$this->getStorage() instanceof ValidatableStorage) {
			$this->setStorage(new ValidatableStorage($this->getStorage()));
		}
		$this->setValueValidator(new SubclassValidator($this->getFactoryClass()));
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
			if($factory->canCreate($args)) {
				return $factory->createArgs($args);
			}
		}

		throw new UnsupportedException('Failed to create an instance. There are no supported factory to create.');
	}

    public function canCreate()
    {
        return $this->canCreateArgs(func_get_args());
    }

	public function canCreateArgs(array $args = array())
	{
		foreach($this as $factory) {
			if($factory->canCreateArgs($args)) {
				return true;
			}
		}
		return false;
	}

    protected function getFactoryClass()
    {
        return 'Clio\Component\Pattern\Factory\Factory';
    }
}

