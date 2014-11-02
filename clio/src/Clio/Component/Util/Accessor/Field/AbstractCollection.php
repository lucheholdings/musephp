<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Container\Container;

/**
 * AbstractCollection 
 * 
 * @uses MultiFieldAccessor
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractCollection implements MultiFieldAccessor 
{

	/**
	 * {@inheritdoc}
	 */
	private $accessors = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(array $accessors = array())
	{
		$this->initContainer($accessors);
	}

	/**
	 * initContainer 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function initContainer(array $accessors);
	
	/**
	 * {@inheritdoc}
	 */
	public function get($container, $field)
	{
		return $this->getFieldAccessor($field)->get($container);
	}
		
	/**
	 * {@inheritdoc}
	 */
	public function set($container, $field, $value)
	{
		$this->getFieldAccessor($field)->set($container, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isNull($container, $field)
	{
		return $this->getFieldAccessor($field)->isNull($container);
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function clear($container, $field)
	{
		$container->getFieldAccessor($field)->clear($container);
		return $this;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function isSupportMethod($container, $field, $type)
	{
		try {
			$accessor = $this->getFieldAccessor($field);
			return $accessor->isSupportMethod($container, $type);
		} catch(\Exception $ex) {
			// Field not exists, so not supported.
			return false;
		}
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function existsField($container, $field)
	{
		return $this->hasFieldAccessor($field);
	}
	
    public function getAccessors()
    {
        return $this->accessors;
    }
    
    /**
     * setAccessors 
     * 
     * @param Container $accessors 
     * @access public
     * @return void
     */
    public function setAccessors(Container $accessors)
    {
        $this->accessors = $accessors;
        return $this;
    }
}

