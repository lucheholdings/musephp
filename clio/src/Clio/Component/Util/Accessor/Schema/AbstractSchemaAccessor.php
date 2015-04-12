<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\SchemaAccessor;
use Clio\Component\Util\Metadata;

abstract class AbstractSchemaAccessor implements SchemaAccessor
{
    /**
     * schema 
     * 
     * @var mixed
     * @access private
     */
    private $schema;

    /**
     * options 
     * 
     * @var mixed
     * @access private
     */
    private $options;

    public function __construct(Metadata\Schema $schema, array $options = array())
    {
        $this->schema = $schema;
        $this->options = $options;
    }

    /**
     * getSchema 
     * 
     * @access public
     * @return void
     */
    public function getSchema()
    {
        return $this->schema;
    }
    
    /**
     * setSchema 
     * 
     * @param mixed $schema 
     * @access public
     * @return void
     */
    public function setSchema(Metadata\Schema $schema)
    {
        $this->schema = $schema;
        return $this;
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
     * createDataAccessor 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function createDataAccessor($data)
    {
        if(!$this->getSchema()->isValidData($data)) {
            throw new \InvalidArgumentException(sprintf('Data is not a valid data of Schema "%s"', $this->getSchema()->getName()));
        }

        return new DataAccessor($this, $data);
    }
}

