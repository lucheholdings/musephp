<?php
namespace Clio\Extra\Accessor\Field;

use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Accessor\Field\MultiFieldAccessor;

use Clio\Component\Exception\UnsupportedException;

/**
 * AttributeMapAccessor 
 * 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapAccessor implements MultiFieldAccessor 
{
	/**
	 * attributeAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributeAccessor;

	/**
	 * __construct 
	 * 
	 * @param mixed $attributeAccessor 
	 * @access public
	 * @return void
	 */
	public function __construct(AttributeAccessor $attributeAccessor = null)
	{
		$this->attributeAccessor = $attributeAccessor;
	}
	
	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($container, $key)
	{
		return $this->getAttributeAccessor()->get($container->getAttributeMap(), $key);
	}

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($container, $key, $value)
	{
		return $this->getAttributeAccessor()->set($container->getAttributeMap(), $key, $value, $container);
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function isNull($container, $key)
	{
		return ($container->getAttributeMap()->has($key) && (null === $container->getAttributeMap()->get($key)->getValue()));
	}

	/**
	 * clear 
	 * 
	 * @param mixed $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function clear($container, $key)
	{
		$container->getAttributeMap()->remove($key);

		return $this;
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($container, $field, $type)
	{
		return true;
	}


	/**
	 * getFieldValues 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function getFieldValues($container)
	{
		return $this->getAttributeAccessor()->getKeyValues($container->getAttributeMap());
	}

	/**
	 * getFieldNames 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($container = null)
	{
		if($container) {
			return $container->getAttributeMap()->getKeys();
		}
		throw new UnsupportedException('AttributeMapAccessor requires $container for getFeildNames()');
	}

	/**
	 * {@inheritdoc}
	 */
	public function existsField($container, $field)
	{
		return $container->getAttributeMap()->has($field);
	}

	/**
	 * getAttributeAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAttributeAccessor()
	{
		return $this->attributeAccessor;
	}
    
    /**
     * setAttributeAccessor 
     * 
     * @param AttributeAccessor $attributeAccessor 
     * @access public
     * @return void
     */
    public function setAttributeAccessor(AttributeAccessor $attributeAccessor)
    {
        $this->attributeAccessor = $attributeAccessor;
        return $this;
    }
}

