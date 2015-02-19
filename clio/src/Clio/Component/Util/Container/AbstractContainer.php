<?php
namespace Clio\Component\Util\Container;

use Clio\Component\Util\Container\Storage\ValidatableStorage;
use Clio\Component\Util\Validator\Validator;

/**
 * AbstractContainer 
 * 
 * @uses Container
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractContainer implements Container
{

	/**
	 * {@inheritdoc}
	 */
	public function __construct(array $defaults= array())
	{
		$this->initContainer($defaults);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $defaults)
	{
	}


	public function merge($other)
	{
		if(!is_array($other) && (!$other instanceof static)) {
			throw new \RuntimeException('Container::merge has to be the same class');
		}

		return new static(array_merge($this->toArray(), $other->toArray()));
	}
}

