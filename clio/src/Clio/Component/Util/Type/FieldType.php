<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Util\Container\Bag;

/**
 * FieldType 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldType extends LazyBindProxyType implements \Serializable
{
	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * parseTypeString 
	 * 
	 * @param mixed $str 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function parseTypeString($str)
	{
		if(!is_string($str)) {
			throw new \InvalidArgumentException(sprintf('Type must to be a string, but %s is given.', gettype($str)));
		}
		$matches = array();
		if(!preg_match('/^(?<name>[a-zA-Z\/\\\]+)(\<(?P<internalTypes>.*?)\>)?(?P<options>\{.*?\})?$/', $str, $matches)) {
			throw new \InvalidArgumentException(sprintf('Invalid format of type "%s"', $str));
		}

		$internalTypes = array();
		$options = array();
		if(isset($matches['options'])) {
			$options = json_decode($matches['options']);
		}

		if(isset($matches['internalTypes'])) {
			$internalTypes = explode(',', $matches['internalTypes']);

			foreach($internalTypes as $k => $v) {
				$internalTypes[$k] = new self($v);
			}

			$options['internal_types'] = $internalTypes;
		}

		return array($matches['name'], $options);
	}

	public function __construct($type, array $options = array())
	{
		if(is_string($type)) {
			list($type, $extra)  = self::parseTypeString($type);
			$options = array_replace($options, $extra);
		}

		$this->options = new Bag($options);

		parent::__construct($type);
	}

	public function __get($name)
	{
		if('options' == $name) {
			return $this->options;
		}

		throw new \Exception(sprintf('Property "%s" is not defined', (string)$name));
	}
    
	public function serialize(array $extra = array())
	{
		return serialize(array(
			$this->getName(),
			$this->options->toArray(),
			$extra
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);

		list(
			$type,
			$options,
			$extra
		) = $data;

		$this->setType($type);
		$this->options = new Bag($options);

		return $extra;
	}
}

