<?php
namespace Clio\Component\Accessor\Field;

use Clio\Component\Accessor\Field;
use Clio\Component\Accessor\FieldAccessor;

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
        if(!$this->isSupportedAccess($container, self::ACCESS_TYPE_GET)) {
            throw new \RuntimeException('Invalid Access.');
        }
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
     * isSupportedAccess 
     *   Return true by default  
     * 
     * @param mixed $container 
     * @param mixed $field 
     * @param mixed $accessType 
     * @access public
     * @return void
     */
	public function isSupportedAccess($container, $accessType)
	{
        switch($accessType) {
        case self::ACCESS_TYPE_GET:
        case self::ACCESS_TYPE_SET:
            return true;
        default:
            throw new \InvalidArgumentException(sprintf('AccessType "%s" is invalid.', (string)$accessType));
        }
	}
}

