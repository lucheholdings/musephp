<?php
namespace Clio\Component\Accessor\Field;

/**
 * ChainedFieldAccessor 
 * 
 * @uses ProxyFieldAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ChainedFieldAccessor extends ProxyFieldAccessor 
{
    /**
     * nextAccessor 
     * 
     * @var mixed
     * @access private
     */
    private $nextAccessor;

    /**
     * {@inheritdoc}
     */
	public function get($container, $field)
    {
        if($this->getBaseAccessor()->existsField($container, $field)) {
            return $this->getBaseAccessor()->get($container, $field);
        }
        
        if($this->nextAccessor) {
            return $this->nextAccessor->get($container, $field);
        }

        throw new \RuntimeException(sprintf('Field "%s" is not exists.', $field));
    }

    /**
     * {@inheritdoc}
     */
	public function set($container, $field, $value)
    {
        if($this->getBaseAccessor()->existsField($container, $field)) {
            return $this->getBaseAccessor()->set($container, $field, $value);
        }
        
        if($this->nextAccessor) {
            return $this->nextAccessor->set($container, $field, $value);
        }

        throw new \RuntimeException(sprintf('Field "%s" is not exists.', $field));
    }

    /**
     * {@inheritdoc}
     */
	public function isNull($container, $field)
    {
        if($this->getBaseAccessor()->existsField($container, $field)) {
            return $this->getBaseAccessor()->isNull($container, $field);
        }
        
        if($this->nextAccessor) {
            return $this->nextAccessor->isNull($container, $field);
        }

        throw new \RuntimeException(sprintf('Field "%s" is not exists.', $field));
    }

    /**
     * {@inheritdoc}
     */
	public function clear($container, $field)
    {
        if($this->getBaseAccessor()->existsField($container, $field)) {
            return $this->getBaseAccessor()->clear($container, $field);
        }
        
        if($this->nextAccessor) {
            return $this->nextAccessor->clear($container, $field);
        }

        throw new \RuntimeException(sprintf('Field "%s" is not exists.', $field));
    }

    /**
     * {@inheritdoc}
     */
	public function getFieldNames($container = null)
    {
        $names = $this->getBaseAccessor()->getFieldNames($container, $field);
        
        if($this->nextAccessor) {
            $names = array_merge($this->nextAccessor->getFieldNames($container), $names);
        }
        
        return $names;
    }

    /**
     * {@inheritdoc}
     */
	public function getFieldValues($container)
    {
        $values = $this->getBaseAccessor()->getFieldValues($container);
        
        if($this->nextAccessor) {
            $values = array_merge($this->nextAccessor->getFieldValues($container, $field), $values);
        }
        
        return $values;
    }

    /**
     * {@inheritdoc}
     */
	public function existsField($container, $field)
    {
        if($this->getBaseAccessor()->existsField($container, $field)) {
            return true;
        }
        
        if($this->nextAccessor) {
            return $this->nextAccessor->existsField($container, $field);
        }

        return false;
    }
    
    /**
     * getNextAccessor 
     * 
     * @access public
     * @return void
     */
    public function getNextAccessor()
    {
        return $this->nextAccessor;
    }
    
    /**
     * setNextAccessor 
     * 
     * @param MultiFieldAccessor $nextAccessor 
     * @access public
     * @return void
     */
    public function setNextAccessor(MultiFieldAccessor $nextAccessor)
    {
        $this->nextAccessor = $nextAccessor;
        return $this;
    }
}

