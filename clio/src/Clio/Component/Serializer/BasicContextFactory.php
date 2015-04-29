<?php
namespace Clio\Component\Serializer;

/**
 * BasicContextFactory 
 * 
 * @uses ContextFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicContextFactory implements ContextFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createContext(array $params = array())
	{
		return new Context($params);
	}
}

