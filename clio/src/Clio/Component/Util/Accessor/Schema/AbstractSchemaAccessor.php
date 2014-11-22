<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\SchemaDataAccessor;
use Clio\Component\Util\Accessor\Field\FieldAccessorCollection;
/**
 * AbstractSchemaAccessor 
 * 
 * @uses FieldAccessorCollection
 * @uses FieldAccessor
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemaAccessor implements SchemaAccessor 
{
	/**
	 * {@inheritdoc}
	 */
	private $schema;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(Schema $schema)
	{
		$this->schema = $schema;
	}
    
    /**
     * {@inheritdoc}
     */
    public function getSchema()
    {
        return $this->schema;
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
		if(!$this->getSchema()->isSchemaData($data)) 
			throw new \InvalidArgumentException('Data is not acceptable type of the schema.');
		return new SchemaDataAccessor($this, $data);
	}
}

