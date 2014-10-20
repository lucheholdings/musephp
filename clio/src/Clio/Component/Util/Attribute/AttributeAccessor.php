<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Util\Attribute\AttributeContainer,
	Clio\Component\Util\Attribute\Attribute;

/**
 * AttributeAccessor 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeAccessor
{
	/**
	 * attributeFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributeFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(AttributeFactory $factory = null)
	{
		if($factory) {
			$factory = new AttributeComponentFactory();
		}
		$this->attributeFactory = $factory;
	}

	/**
	 * createAttribute 
	 * 
	 * @access public
	 * @return void
	 */
	public function createAttribute($key, $value)
	{
		$attr = $this->getAttributeFactory()->createAttribute($key, $value);

		return $attr;
	}

	/**
	 * get 
	 * 
	 * @param AttributeContainer $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get(AttributeContainer $container, $key)
	{
		if(!$container->hasKey($key)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('AttributeContainer dose not have "%s"', $key));
		}

		return $container->get($key)->getValue();	
	}

	/**
	 * set 
	 * 
	 * @param AttributeContainer $container 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set(AttributeContainer $container, $key, $value, $owner = null)
	{
		if($container->hasKey($key)) {
			$container->get($key)->setValue($value);
		} else {
			$container->set($key, $this->createAttribute($key, $value, $owner));
		}

		return $this;
	}

	/**
	 * add
	 * 
	 * @param Attribute $attr 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function add(AttributeContainer $container, $key, $value, $owner = null)
	{
		if(!$container->hasKey($key)) {
			$container->set($key, $this->createAttribute($key, $value, $owner));
		}
		return $this;
	}
	
	/**
	 * removeAttributeName 
	 * 
	 * @param Attribute $attr 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove(AttributeContainer $container, $key)
	{
		$container->removeAttribute($container, $key);
		return $this;
	}

	/**
	 * replace
	 * 
	 * @param AttributeContainer $container 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function replace(AttributeContainer $container, array $keyValues)
	{
		// once remove all attrs
		$deleteSchedules = $container->getKeys();

		foreach($keyValues as $key => $value) {
			if(false !== ($idx = array_search($key, $deleteSchedules))) {
				// unset from the deleteSchedule
				unset($deleteSchedules[$idx]);
			} else {
				$this->addAttribute($container, $key, $value);
			}
		}

		foreach($deleteSchedules as $key) {
			$container->removeAttribute($key);
		}

		return $container;
	}

    /**
     * Get attributeFactory.
     *
     * @access public
     * @return attributeFactory
     */
    public function getAttributeFactory()
    {
        return $this->attributeFactory;
    }
    
    /**
     * Set attributeFactory.
     *
     * @access public
     * @param attributeFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAttributeFactory($attributeFactory)
    {
        $this->attributeFactory = $attributeFactory;
        return $this;
    }
}

