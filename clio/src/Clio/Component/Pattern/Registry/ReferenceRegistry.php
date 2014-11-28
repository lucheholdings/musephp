<?php
namespace Clio\Component\Pattern\Registry;

/**
 * ReferenceRegistry 
 * 
 * @uses ProxyRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ReferenceRegistry extends ProxyRegistry 
{
	/**
	 * {@inheritdoc}
	 */
	public function set($key, $entry) 
	{
		throw new \RuntimeException('ReferenceRegistry dose not accept "set" method. It can only reference the another registry.');
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($key)
	{
		throw new \RuntimeException('ReferenceRegistry dose not accept "remove" method. It can only reference the another registry.');
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
    {
		throw new \RuntimeException('ReferenceRegistry dose not accept "clear" method. It can only reference the another registry.');
    }
}

