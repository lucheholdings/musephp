<?php
namespace Clio\Adapter\DoctrineExtensions\Cache;


use Clio\Component\Pattern\Factory\MappedComponentFactory;
use Clio\Component\Exception\UnsupportedException;

/**
 * CacheFactory 
 * 
 * @uses MappedComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CacheFactory extends MappedComponentFactory 
{
	/**
	 * {@inheritdoc}
	 */
	protected function initFactory()
	{
		$this->setMappedClass('jsonfile', 'Clio\Adapter\DoctrineExtensions\Cache\JsonFileCache');
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'jsonfile':
			$cache = parent::createByKeyArgs($key, $args);
			break;
		default:
			throw new UnsupportedException(sprintf('Cache type "%s" is not supported type.', $key));
		}

		return $cache;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		switch($key) {
		case 'jsonfile':
			return true;
		default:
			return false;
		}
	}

	protected function resolveKeyArgs($key, array $args = array())
	{
		$options = array_shift($args);
		switch($key) {
		case 'jsonfile':
			return array($options['directory'], isset($options['extension']) ? $options['extension'] : null);
		default:
			return array();
		}
	}
}

