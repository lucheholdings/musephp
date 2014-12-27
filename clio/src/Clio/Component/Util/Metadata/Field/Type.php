<?php
namespace Clio\Component\Util\Metadata\Field;

/**
 * Type 
 *   String Format
 * 
 *  "integer"        => type = Integer
 *  "array<integer>" => type = Array + internalType=Integer 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Type implements \Serializable 
{
	const TYPE_MIXED   = 'mixed';
	const TYPE_INTEGER = 'integer';
	const TYPE_STRING  = 'string';
	const TYPE_BOOLEAN = 'boolean';
	const TYPE_ARRAY   = 'boolean';


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
		if(!preg_match('/^(?<name>[a-zA-Z\/\\\]+)(\<(?P<internalType>.*?)\>)?$/', $str, $matches)) {
			throw new \InvalidArgumentException(sprintf('Invalid format of type "%s"', $str));
		}

		return array($matches['name'], isset($matches['internalType']) ? new self($matches['internalType']) : null);
	}
	
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * internalType 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $internalType;

	/**
	 * __construct 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function __construct($type)
	{
		if(is_string($type)) {
			list(
				$this->name,
				$this->internalType
			) = self::parseTypeString($type);
		} else if(is_array($type)) {
			list(
				$this->name,
				$this->internalType
			) = $type;
		}
	}

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	/**
	 * hasInternalType 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasInternalType()
	{
		return (bool)$this->internalType;
	}
    
    /**
     * getInternalType 
     * 
     * @access public
     * @return void
     */
    public function getInternalType()
    {
        return $this->internalType;
    }
    
    /**
     * setInternalType 
     * 
     * @param Type $internalType 
     * @access public
     * @return void
     */
    public function setInternalType(Type $internalType)
    {
        $this->internalType = $internalType;
        return $this;
    }

	public function __toString()
	{
		return $this->name;
	}

	public function serialize(array $extra = array())
	{
		return serialize(array(
			$this->name,
			$this->internalType,
			$extra
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);

		list(
			$this->name,
			$this->internalType,
			$extra
		) = $data;

		return $extra;
	}
}

