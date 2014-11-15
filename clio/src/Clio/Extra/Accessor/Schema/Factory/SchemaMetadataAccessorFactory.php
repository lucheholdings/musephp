<?php
namespace Clio\Extra\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema\Factory\FieldSchemaAccessorFactory;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Field;

/**
 * SchemaMetadataAccessorFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessorAwareSchemaAccessorFactory extends FieldSchemaAccessorFactory
{
	protected function createFieldAccessors(Schema $schema)
	{
		$accessor = $namedAccessor = new Field\NamedCollection();
		foreach($schema->getFields() as $field) {
			$fieldAccessor = $field->getAccessor();

			if($fieldAccessor instanceof Field\SingleFieldAccessor) {
				$namedAccessor->addFieldAccessor($fieldAccessor);
			} else if($fieldAccessor instanceof Field\MultiFieldAccessor) {
				if(!$accessor instanceof Field\ChainedFieldAccessor) {
					$accessor = new Field\ChainedFieldAccessor($accessor, $fieldAccessor);
				} else {
					$accessor->addNext($fieldAccessor);
				}
			}
		}

		return $accessor;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedSchema(Schema $schema)
	{
		return ($schema instanceof AccessorAwareSchema);
	}
}
