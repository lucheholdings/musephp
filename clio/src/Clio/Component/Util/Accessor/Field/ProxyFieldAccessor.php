<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\FieldAccessor;

/**
 * ProxyFieldAccessor 
 *   ProxyFieldAccessor supports both Single and Multi FieldAccessors, and provides as MultiFieldAccessor. 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyFieldAccessor implements MultiFieldAccessor 
{
    /**
     * baseAccessor 
     *   Proxy base FieldAccessor 
     * @var FieldAccessor 
     * @access protected
     */
    protected $baseAccessor;

    /**
     * __construct 
     * 
     * @param FieldAccessor $baseAccessor 
     * @access public
     * @return void
     */
    public function __construct(FieldAccessor $baseAccessor)
    {
        $this->baseAccessor = $baseAccessor;
    }

    /**
     * {@inheritdoc}
     */
	public function get($container, $field)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return $this->getBaseAccessor()->get($container); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->get($container, $field);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function set($container, $field, $value)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return $this->getBaseAccessor()->set($container, $value); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->set($container, $field, $value);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function isNull($container, $field)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return $this->getBaseAccessor()->isNull($container); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->isNull($container, $field);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function clear($container, $field)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return $this->getBaseAccessor()->clear($container); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->clear($container, $field);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function getFieldNames($container = null)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return array($this->getBaseAccessor()->getFieldName($container)); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->getFieldNames($container);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function getFieldValues($container)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return array($this->getBaseAccessor()->getFieldName() => $this->getBaseAccessor()->get($container)); 
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->getFieldValues($container, $field);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
	public function existsField($container, $field)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return true;
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->existsField($container, $field);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isSupportedAccess($container, $field, $accessType)
    {
        if($this->getBaseAccessor() instanceof SingleFieldAccessor) {
            return ($field == $this->getBaseAccessor()->getFieldName()) && $this->getBaseAccessor()->isSupportedAccess($container, $accessType);
        } else if($this->getBaseAccessor() instanceof MultiFieldAcccessor) {
            return $this->getBaseAccessor()->isSupportedAccess($container, $field, $accessType);
        } else {
            throw new \RuntimeException('Not Implemented');
        }
    }
    
    /**
     * getBaseAccessor 
     * 
     * @access public
     * @return void
     */
    public function getBaseAccessor()
    {
        return $this->baseAccessor;
    }
}

