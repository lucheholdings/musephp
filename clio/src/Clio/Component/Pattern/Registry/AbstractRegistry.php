<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Util\Container\Map\Map;

/**
 * AbstractRegistry 
 * 
 * @uses Map
 * @uses Reigstry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractRegistry implements Registry
{
	private $values = array();

	public function has($key)
	{
		return isset($this->values[$key]);
	}

	public function set($key, $value)
	{
		if(!$this->isValidValue($value)) {
			throw new \InvalidArgumentException(sprintf(
				'Invalid value type "%s" is given.', 
				is_object($value) ? get_class($value) : gettype($value)
			));
		}

		$this->values[$key] = $value;

		return $this;
	}

	public function get($key)
	{
		if(!isset($this->values[$key])) {
			throw new \RuntimeException(sprintf('Key "%s" is not registed.', $key));
		}

		return $this->values[$key];
	}

	public function delete($key)
	{
		if(!isset($this->values[$key])) {
			throw new \RuntimeException(sprintf('Key "%s" is not registed.', $key));
		}

		$deleted = $this->values[$key];
		unset($this->values[$key]);

		return $deleted;
	}

	public function getAll()
	{
		return $this->values;
	}

	protected function isValidValue($value)
	{
		return is_object($value);
	}
}

