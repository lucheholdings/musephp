<?php
namespace Clio\Component\Util\Type;

/**
 * Resolver 
 *   Resolver is to resolve an ambiguous type to concrete type.
 *   Ambiguos Type includes,
 *     - string: Name of a concrete type
 *     - type object: an instanceof ambiguos type such as Mixed, Proxy.
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Resolver
{
	/**
	 * resolve 
	 * 
	 * @param Type|string $type Target type or name of type
	 * @param array $options 
	 * @access public
	 * @return Type 
	 */
	function resolve($type, array $options = array());

    /**
     * canResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    function canResolve($type, array $options = array());
}

