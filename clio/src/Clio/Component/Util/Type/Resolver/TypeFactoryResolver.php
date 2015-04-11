<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\Factory as TypeFactory;
use Clio\Component\Exception\UnsupportedException;

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
        return $this->getTypeFactory()->canCreateType($type);
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
		if(!$this->getTypeFactory()->canCreateType($type)) {
			throw new UnsupportedException(sprintf('Type "%s" is not supported.', (string)$type));	
		}

		return $this->getTypeFactory()->createType($type, $options);
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

