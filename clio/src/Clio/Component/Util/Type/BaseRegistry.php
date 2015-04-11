<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Registry\LoadableRegistry,
    Clio\Component\Pattern\Loader\FactoryLoader
;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * BaseRegistry 
 *    BaseRegistry is an empty registry which only configure 
 *    the rule of Type Registry. 
 * @uses LoadableRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BaseRegistry extends LoadableRegistry implements Registry
{
    /**
     * _resolver 
     *   Resolver with Registered type 
     * @var mixed
     * @access private
     * @temporary
     */
    private $_resolver;

    /**
     * _guesser 
     *   Guesser with registered type.
     * 
     * @var mixed
     * @access private
     * @temporary
     */
    private $_guesser;

    /**
     * __construct 
     * 
     * @param Factory $typeFacotry 
     * @access public
     * @return void
     */
	public function __construct(Factory $typeFactory)
	{
		parent::__construct(new FactoryLoader($typeFactory));
	}

    /**
     * getTypes 
     * 
     * @access public
     * @return void
     */
    public function getTypes()
    {
        return $this->getValues();
    }
    
    /**
     * setTypes 
     * 
     * @param array $types 
     * @access public
     * @return void
     */
    public function setTypes(array $types)
    {
		return $this->replace($types);
    }

	/**
	 * hasType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function hasType($type)
	{
		return $this->has((string)$type);
	}

	/**
	 * getType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function getType($type)
	{
		if($type instanceof Type) {
			return $type;
		}

		return $this->get((string)$type);
	}

	/**
	 * addType 
	 * 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function addType(Type $type)
	{
		return $this->set($type->getName(), $type);
	}

	/**
	 * removeType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function removeType($type)
	{
		return $this->remove((string)$type);
	}

    /**
     * getResolver 
     * 
     * @access public
     * @return void
     */
    public function getResolver()
    {
        if($this->_resolver) {
            $this->_resolver = Resolver\Factory::createWithRegistry($this);
        }
        return $this->_resolver;
    }

    /**
     * getGuesser 
     * 
     * @access public
     * @return void
     */
    public function getGuesser()
    {
        if(!$this->_guesser)
            $this->_guesser = Guesser\SimpleGuesser::create($this->getResolver());
        return $this->_guessor;
    }
}

