<?php
namespace Clio\Component\Util\Accessor;

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
abstract class AbstractSchemaAccessor extends FieldAccessorCollection
{
	/**
	 * {@inheritdoc}
	 */
	private $schema;

	/**
	 * {@inheritdoc}
	 */
	public function __construct($schema, array $fields = array())
	{
		parent::__construct($fields);

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
     * {@inheritdoc}
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }
}

