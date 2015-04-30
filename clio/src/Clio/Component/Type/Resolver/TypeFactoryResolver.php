<?php
namespace Clio\Component\Type\Resolver;

use Clio\Component\Type\Resolver;
use Clio\Component\Type\Factory as TypeFactory;
use Clio\Component\Type\Exception as TypeException;
use Clio\Component\Pattern\Factory;

/**
 * TypeFactoryResolver 
 *   Resolve Type with creating a new Type by Factory 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeFactoryResolver implements Resolver
{
    /**
     * typeFactory 
     * 
     * @var mixed
     * @access private
     */
	private $typeFactory;

	/**
	 * __construct 
	 * 
	 * @param TypeFactory $typeFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeFactory $typeFactory)
	{
		$this->typeFactory = $typeFactory;
	}

    /**
     * canResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canResolve($type, array $options = array())
    {
        try {
            return (bool)$this->getTypeFactory()->createType($type, $options);
        } catch(Factory\Exception $ex) {
            return false;
        }
    }

	/**
	 * resolve 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function resolve($type, array $options = array())
	{
        try {
		    return $this->getTypeFactory()->createType($type, $options);
        } catch(Factory\Exception $ex) {
			throw new TypeException\InvalidTypeException(sprintf('Type "%s" is not exists.', (string)$type), 0, $ex);
        }
	}
    
    /**
     * getTypeFactory 
     * 
     * @access public
     * @return void
     */
    public function getTypeFactory()
    {
        return $this->typeFactory;
    }
    
    /**
     * setTypeFactory 
     * 
     * @param TypeFactory $typeFactory 
     * @access public
     * @return void
     */
    public function setTypeFactory(TypeFactory $typeFactory)
    {
        $this->typeFactory = $typeFactory;
        return $this;
    }
}

