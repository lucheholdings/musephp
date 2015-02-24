<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Util\Container\Bag;
use Clio\Component\Pattern\Registry\LoadableRegistry;

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
		if(!preg_match('/^(?P<name>[a-zA-Z\/\\\]+)(\<(?P<decoratedType>.*)\>)?(\{(?P<options>.*)\})?$/', $str, $matches)) {
			throw new \InvalidArgumentException(sprintf('Invalid format of type "%s"', $str));
		}

		$options = array();
		if(isset($matches['options'])) {

			//$options = json_decode($matches['options']);
			$kvs = explode(',', $matches['options']);

			foreach($kvs as $kv) {
				// Simple parsing
				try {
					list($key, $value) = explode('=', $kv);
					$options[trim($key)] = trim($value);
				} catch(\Symfony\Component\Debug\Exception\ContextErrorException $ex) {
					throw new \InvalidArgumentException(sprintf('FieldType for "%s" is invalid format.', $str));
				}
			}
		}

		if(isset($matches['decoratedType']) && !empty($matches['decoratedType'])) {
			$options['decorated_type'] = new self($matches['decoratedType']);
			//var_dump($options);
		}

		return array($matches['name'], $options);
	}

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	public function __construct($type = null, array $options = array())
	{
		if(null == $type) {
			$type = new MixedType();
		} else if(is_string($type)) {
			list($type, $extra)  = self::parseTypeString($type);
			$options = array_replace($options, $extra);
		}

		$this->options = new Bag($options);

		parent::__construct($type);
	}

	public function isType($type)
	{
		switch($type) {
		case 'field':
			return true;
		default:
			return $this->getType()->isType($type);
		}
	}

	public function resolve(Resolver $resolver, $data = null)
	{
		if(!$this->type instanceof Type) {
			$this->type = $resolver->resolve($this->type, $this->options->toArray());
		}

		if(!$this->isResolved()) {
			// resolve mixed tyep
			$this->type = $this->type->resolve($resolver, $data);
		}

		return $this;
	}

	public function getTypeName()
	{
		if(!$this->type instanceof Type) {
			return $this->type;
		} else {
			return $this->type->getName();
		}
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

