<?php
namespace Clio\Framework\Metadata\Mapping;

/**
 * FieldAccessorMapping 
 * 
 * @uses AccessorMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorMapping extends AccessorMapping 
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * accessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessorFactory;

	/**
	 * __construct 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct($type, array $options = array())
	{
		$this->type = $type;

		parent::__construct($options);
	}
    
    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		return serialize(array(
			$this->type,
			$this->getOptions()
		));
	}
	

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		list(
			$this->type,
			$options
		) = unserialize($serialized);

		$this->setOptions($options);
	}
    
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    public function setAccessorFactory($accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }

	public function getAccessor()
	{
		if(!$this->accessor) {
			$this->accessor = $this->getAccessorFactory()->createFieldAccessorByType($this->type, $this->getMetadata(), $this->getMetadata()->getName());
		}

		return $this->accessor;
	}
}

