<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\Factory as TypeFactory;
use Clio\Component\Exception\UnsupportedException;

class TypeFactoryResolver implements Resolver
{
	private $factory;
	/**
	 * __construct 
	 * 
	 * @param TypeFactory $factory 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeFactory $factory)
	{
		$this->factory = $factory;
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
		if(!$this->getTypeFactory()->isSupportedType($type)) {
			throw new UnsupportedException(sprintf('Type "%s" is not supported.', (string)$type));	
		}

		return $this->getTypeFactory()->createType($type, $options);
	}
    
    public function getTypeFactory()
    {
        return $this->factory;
    }
    
    public function setTypeFactory(TypeFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}

