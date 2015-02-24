<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\MixedType;
use Clio\Component\Exception\UnsupportedException;

class MixedTypeResolver implements Resolver 
{
	private $typeResolver;

	public function __construct(Resolver $typeResolver)
	{
		$this->typeResolver = $typeResolver;
	}

	public function resolve($type, array $options = array())
	{
		if(('mixed' == (string)$type) && array_key_exists('data', $options)) {
			$data = $options['data'];
		
			$resolved = $this->getTypeResolver()->resolve(is_object($data) ? get_class($data) : gettype($data));
			return $resolved;
		}

		throw new UnsupportedException('MixedTypeResolver only support with MixedType and "data" in options.');
	}
    
    public function getTypeResolver()
    {
        return $this->typeResolver;
    }
    
    public function setTypeResolver($typeResolver)
    {
        $this->typeResolver = $typeResolver;
        return $this;
    }
}

