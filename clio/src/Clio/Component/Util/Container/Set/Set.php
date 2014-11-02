<?php
namespace Clio\Component\Util\Container\Set;

use Clio\Component\Util\Container\Set as SetInterface;
use Clio\Component\Util\Container\AbstractContainer;

/**
 * Set 
 * 
 * @uses AbstractContainer
 * @uses Set
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Set extends AbstractContainer implements SetInterface 
{
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		foreach($values as $value) {
			$this->storage->insert($value);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function add($value)
	{
		$key = $this->getStorage()->insert($value);

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function contains($value)
	{
		return $this->getStorage()->exists($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		$this->storage->remove($value);
		return $this;
	}
}

