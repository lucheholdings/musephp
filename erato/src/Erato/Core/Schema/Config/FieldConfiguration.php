<?php
namespace Erato\Core\Schema\Config;

use Clio\Component\Util\Type;

/**
 * FieldConfiguration 
 *    
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldConfiguration extends AbstractConfiguration implements \Serializable 
{
    /**
     * name 
     * 
     * @var mixed
     * @access private
     */
    public $name;

    /**
     * type 
     * 
     * @var mixed
     * @access private
     */
    public $type;

    public function __construct()
    {
        $this->type = new Type\MixedType();
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * {@inheritdoc}
     */
    public function merge(Configuration $config)
    {
        parent::merge($config);

        if($config->type)
            $this->type = $config->type;

        return $this;
    }

    /**
     * serialize 
     * 
     * @param array $extra 
     * @access public
     * @return void
     */
    public function serialize(array $extra = array())
    {
        $data = array(
                $this->name,
                $this->type,
                $this->options,
                $this->mappings,
                $extra,
            );

        return serialize($data);
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
        $data = unserialize($serialized);

        list(
                $this->name,
                $this->type,
                $this->options,
                $this->mappings,
                $extra
            ) = $data;

        return $extra;
    }
}

