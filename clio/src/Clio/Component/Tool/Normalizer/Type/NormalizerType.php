<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type as TypeInterface;
use Clio\Component\Util\Type as Types;

/**
 * NormalizerType 
 * 
 * @uses Clio\Component\Util\Type\ProxyType;
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NormalizerType extends Types\ProxyType implements TypeInterface 
{
    /**
     * options 
     * 
     * @var array
     * @access private
     */
    private $options = array();

    /**
     * __construct 
     * 
     * @param Clio\Component\Util\Type\Type $type 
     * @access public
     * @return void
     */
    public function __construct(Types\Type $type = null)
    {
        if(!$type) {
            $type = new Types\Actual\MixedType();
        }
        parent::__construct($type);
    }

    public function hasField($field)
    {
        $type = $this->getType();

        if($type instanceof Types\Actual\ClassType) {
            return $type->getReflector()->hasProperty($field);
        }

        return false;
    }

    public function getFieldType($field)
    {
        if($this->hasField($field)) {
            return new self();
        }

        throw new \RuntimeException(sprintf('Field "%s" is not exists.', $field));
    }
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param mixed $options 
     * @access public
     * @return void
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * hasOption 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function hasOption($key)
    {
        return isset($this->options[$key]);
    }

    /**
     * getOption 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }

    /**
     * setOption 
     * 
     * @param mixed $key 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }
}

