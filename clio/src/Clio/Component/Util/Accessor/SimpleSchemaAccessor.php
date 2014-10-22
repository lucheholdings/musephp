<?php
namespace Clio\Component\Util\Accessor;

use Clio\Component\Util\Accessor\Field\FieldAccessorCollection;

/**
 * SimpleSchemaAccessor 
 * 
 * @uses AbstractSchemaAccessor 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleSchemaAccessor extends FieldAccessorCollection implements SchemaAccessor 
{
	/**
	 * createDefaultAccessor 
	 *   Create ClassAccessor with Default FieldAccessors
	 *   such as 
	 *     - PublicPropertyFieldAccessor
	 *     - MethodFieldAccessor 
	 * 
	 * @param mixed $schema 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createClassAccessor($schema)
	{
		static $factory = null;
		if(!$factory) {
			$factory = new BasicClassAccessorFactory();
		}

		return $factory->createSchemaAccessor($schema);
	}

	/**
	 * schema 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schema;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $schema 
	 * @param array $accessors 
	 * @access public
	 * @return void
	 */
	public function __construct($schema, array $accessors = array(), array $options = array())
	{
		parent::__construct($accessors);

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
}

