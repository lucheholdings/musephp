<?php
namespace Clio\Component\Util\Type\Loader;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader;
use Clio\Component\Exception\UnsupportedException;

/**
 * MappedTypeFactoryLoader 
 * 
 * @uses MappedFactoryLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MappedTypeFactoryLoader extends MappedFactoryLoader 
{
	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key, array $options = array())
	{
		try {
			return $this->getFactory()->createByKey($key, $options);
		} catch(UnsupportedException $ex) {
			return null;
		}
	}
}

