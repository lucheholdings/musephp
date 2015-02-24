<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\Registry;
use Clio\Component\Util\Type\Type;

class RegistryResolver implements Resolver
{
	private $registry;
	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(Registry $registry)
	{
		$this->registry = $registry;
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
		if(('mixed' == (string)$type) && isset($options['data'])) {
			return $this->getRegistry()->guessType($options['data']);
		}

		if($type instanceof Type) {
			return $type;
		}
		
		// try get type object
		return $this->getRegistry()->get($type);
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

