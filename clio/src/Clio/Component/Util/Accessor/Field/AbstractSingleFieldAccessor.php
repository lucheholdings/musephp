<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\FieldAccessor;

/**
 * AbstractSingleFieldAccessor 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSingleFieldAccessor implements SingleFieldAccessor 
{
	/**
	 * fieldName 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $fieldName;

	/**
	 * __construct 
	 * 
	 * @param mixed $fieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($fieldName)
	{
		$this->fieldName = $fieldName;
	}
    
    /**
     * getFieldName
     * 
     * @access public
     * @return void
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }
    
    /**
     * setFieldName
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
        return $this;
    }

	/**
	 * has 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function isNull($container)
	{
		return null === $this->get($container);
	}

	/**
	 * clear 
	 *   Set Null on the field.
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function clear($container)
	{
		$this->set($container, null);

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportMethod($container, $field, $methodType)
	{
		return $field === $this->getFieldName();
	}
}

