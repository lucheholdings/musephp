<?php
namespace Clio\Component\Util\Type\Loader;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader;
use Clio\Component\Exception\UnsupportedException;

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

