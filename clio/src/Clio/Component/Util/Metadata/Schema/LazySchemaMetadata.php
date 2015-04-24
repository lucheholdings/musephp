<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Field;
use Clio\Component\Util\Metadata\Resolver;
use Clio\Component\Util\Type as Types;

class LazySchemaMetadata implements Schema 
{
    private $resolver;

    private $ref;

    public function __construct(Resolver $resolver, $resource)
    {
        $this->resolver = $resolver;
        $this->ref = $resource;
    }

    public function getName()
    {
        return (string)$this->ref;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function newData(array $args = array())
    {
        return $this->getLoaded()->newData($args);
    }

    public function getTypeName()
    {
        return $this->getLoaded()->getTypeName();
    }

    public function getType()
    {
        return $this->getLoaded()->getType();
    }

    public function getFields()
    {
        return $this->getLoaded()->getFields();
    }

    /**
     * hasField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function hasField($field)
    {
        return $this->getLoaded()->getFields();
    }

    /**
     * getField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function getField($field)
    {
        return $this->getLoaded()->getField($field);
    }

    /**
     * isValidData 
     * 
     * @access public
     * @return void
     */
    public function isValidData($data)
    {
        return $this->getLoaded()->isValidData($data);
    }

    public function getLoaded()
    {
        if(is_string($this->actual)) {
            $this->ref = $this->resolver->resolve($this->actual);
        }

        if($this->ref instanceof Schema) {
            throw new \RuntimeException('Failed to load lazy object.');
        }
        return $this->ref;
    }
}

