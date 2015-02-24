<?php
namespace Clio\Component\Pattern\Registry\Loader;

use Clio\Component\Pattern\Registry\EntryLoader;
use Clio\Component\Util\Container\Set\PrioritySet;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * LoaderCollection 
 * 
 * @uses PrioritySet
 * @uses EntryLoader
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LoaderCollection extends PrioritySet implements EntryLoader
{
	/**
	 * initContainer 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		$this->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Pattern\Registry\EntryLoader'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key, array $options = array())
	{
		foreach($this as $loader) {
			$entry = $loader->loadEntry($key, $options);

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

	public function addLoader(EntryLoader $loader)
	{
		$this->add($loader);
		return $this;
	}
}

