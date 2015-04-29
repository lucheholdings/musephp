<?php
namespace Clio\Component\Serializer;

/**
 * ContextFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ContextFactory
{
	/**
	 * createContext 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	function createContext(array $params = array());
}

