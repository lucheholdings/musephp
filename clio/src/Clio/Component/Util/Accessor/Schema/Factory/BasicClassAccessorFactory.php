<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field\Factory\PublicPropertyFieldAccessorFactory,
	Clio\Component\Util\Accessor\Field\Factory\MethodFieldAccessorFactory
;
use Clio\Component\Util\Accessor\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\Schema;

/**
 * BasicClassAccessorFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicClassAccessorFactory extends FieldSchemaAccessorFactory
{
	static public function createFactory(array $fieldFactories = array())
	{
		// Use defualt fieldFactories
		if(empty($fieldFactories)) {
			$fieldFactories = array(
				'public_property' => new PublicPropertyFieldAccessorFactory(),
				'method' => new MethodFieldAccessorFactory(),
			);
		}
		return new static(new FieldAccessorFactoryCollection($fieldFactories));
	}

	protected function getFieldsFromSchema(Schema $schema)
	{
		if(!$schema instanceof \ReflectionClass) {
			throw new \InvalidArgumentException('Schema has to be an instanceof ReflectionClass.');
		}

		$fields = array_map(function($property){
			return $property->getName();
		}, $schema->getProperties());

		return $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema(Schema $schema)
	{
		return ($schema instanceof \ReflectionClass);
	}
}

