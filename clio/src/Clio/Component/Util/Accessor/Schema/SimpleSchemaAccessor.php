<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\SchemaAccessor;
use Clio\Component\Util\Accessor\SchemaDataAccessor;
use Clio\Component\Util\Accessor\Field\MultiFieldAccessor;
use Clio\Component\Util\Accessor\Field\ProxyMultiFieldAccessor;

/**
 * SimpleSchemaAccessor 
 * 
 * @uses AbstractSchemaAccessor 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleSchemaAccessor extends ProxyMultiFieldAccessor implements SchemaAccessor
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

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param array $accessors 
	 * @access public
	 * @return void
	 */
	public function __construct(Schema $schema, MultiFieldAccessor $fields, array $options = array())
	{
		parent::__construct($fields);

		$this->options = $options;
		$this->schema = $schema;
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

	public function getFieldAccessors()
	{
		return $this->getAccessor();
	}

	public function createDataAccessor($data)
	{
		if(!$this->getSchema()->isSchemaData($data)) 
			throw new \InvalidArgumentException('Data is not acceptable type of the schema.');
		return new SchemaDataAccessor($this, $data);
	}
}

