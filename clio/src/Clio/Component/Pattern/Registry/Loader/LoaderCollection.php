<?php
namespace Clio\Component\Pattern\Registry\Loader;

use Clio\Component\Pattern\Registry\EntryLoader;
use Clio\Component\Util\Container\Collection\PriorityCollection;

/**
 * LoaderCollection 
 * 
 * @uses PriorityCollection
 * @uses EntryLoader
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LoaderCollection extends PriorityCollection implements EntryLoader
{
	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key)
	{
		foreach($this as $loader) {
			$entry = $loader->loadEntry($key);

			if(null !== $entry) {
				break;
			}
		}

		return $entry;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($key)
	{
		foreach($this as $loader) {
			if($loader->canLoad($key)) {
				return true;
			}
		}
		return false;
	}
}

