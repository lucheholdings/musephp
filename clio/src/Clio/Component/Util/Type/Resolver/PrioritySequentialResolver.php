<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type;
use Clio\Component\Exception\UnsupportedException;

/**
 * PrioritySequentialResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PrioritySequentialResolver extends SequentialResolver
{
	private $_resolvers = array();

	public function addResolver(Resolver $resolver, $priority = 0)
	{
		$this->_resolvers[$priority][] =  $resolver;
		$this->resolvers = null;
	}
    
    public function getResolvers()
    {
		$resolvers = parent::getResolvers();
		if(empty($resolvers)) {
			krsort($this->_resolvers);
			$sorted = array();
			foreach($this->_resolvers as $priority => $resolvers) {
				$sorted = array_merge($sorted, $resolvers);
			}

			parent::setResolvers($sorted);
			$resolvers = $sorted;
		}
        return $resolvers;
    }
}

