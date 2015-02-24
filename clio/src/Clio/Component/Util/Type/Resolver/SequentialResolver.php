<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\Type;
use Clio\Component\Exception\UnsupportedException;

/**
 * SequentialResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialResolver implements Resolver 
{
	private $resolvers = array();

	public function resolve($type, array $options = array())
	{
		$resolvers = $this->getResolvers();
		foreach($resolvers as $resolver) {
			try {
				$type = $resolver->resolve($type, $options);
				break;
			} catch(UnsupportedException $ex) {
				// 
				continue;
			}
		}

		if(!$type instanceof Type) {
			throw new UnsupportedException(sprintf('Type "%s" cannot be solved', $type));
		}

		return $type;
	}

	public function appendResolver(Resolver $resolver)
	{
		array_push($this->resolvers, $resolver);
	}

	public function prependResolver(Resolver $resolver)
	{
		array_unshift($this->resolvers, $resolver);
	}
    
    public function getResolvers()
    {
        return $this->resolvers;
    }
    
    public function setResolvers($resolvers)
    {
        $this->resolvers = $resolvers;
        return $this;
    }
}

