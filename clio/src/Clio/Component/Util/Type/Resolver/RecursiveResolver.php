<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type as Types;

/**
 * RecursiveResolver 
 *   Recursively resolve the type  
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class RecursiveResolver implements Resolver 
{
	private $baseResolver;

	public function __construct(Resolver $baseResolver)
	{
		$this->baseResolver = $baseResolver;
	}

	/**
	 * resolve 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function resolve($type, array $options = array())
	{
		$type = $this->getBaseResolver()->resolve($type, $options);
		
		if($type instanceof Types\ProxyType) {
			$type->setType($this->resolve($type->getType(), $options));
		}

		return $type;
	}
    
    public function getBaseResolver()
    {
        return $this->baseResolver;
    }
    
    public function setBaseResolver(Resolver $baseResolver)
    {
        $this->baseResolver = $baseResolver;
        return $this;
    }
}

