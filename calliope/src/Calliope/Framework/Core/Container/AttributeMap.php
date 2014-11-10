<?php
namespace Calliope\Framework\Core\Container;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Attribute\AttributeMap;

use Clio\Component\Util\Attribute\Attribute;
use Clio\Component\Util\Attribute\AttributeMapAware;

use Clio\Component\Util\Validator\PrimitiveTypeValidator,
	Clio\Component\Util\Validator\ClassValidator
;
/**
 * AttributeMap 
 * 
 * @uses ObjectMap
 * @uses AttributeMap
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMap extends Map implements AttributeMap
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $owner;

	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		$this->enableStorageValidation();

		$this->getStorage()->setKeyValidator(new PrimitiveTypeValidator('string'));
		$this->getStorage()->setValueValidator(new ClassValidator('Clio\Component\Util\Attribute\Attribute'));
	}

	/**
	 * addAttribute 
	 * 
	 * @param mixed $key 
	 * @param Attribute $value 
	 * @access public
	 * @return void
	 */
	public function addAttribute(Attribute $value)
	{
		$this->set($value->getKey(), $value);
		return $this;
	}

	/**
	 * getAttribute 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAttribute($key)
	{
		return $this->get($key);
	}

	/**
	 * getAttributeValue 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAttributeValue($key)
	{
		return $this->getAttribute($key)->getValue();
	}
    
    /**
     * Get owner.
     *
     * @access public
     * @return owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set owner.
     *
     * @access public
     * @param owner the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOwner(AttributeMapAware $owner)
    {
        $this->owner = $owner;
        return $this;
    }

	public function getKeyValueArray()
	{
		return array_map(function($attr) {
			return $attr->getValue();
		}, $this->getKeyValues());
	}
}

