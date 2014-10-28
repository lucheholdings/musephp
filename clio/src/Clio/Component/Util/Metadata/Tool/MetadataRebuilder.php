<?php
namespace Clio\Component\Util\Metadata\Tool;

use Clio\Component\Util\Execution\Invoker;
use Clio\Component\Util\Injection\Injector;

use Clio\Component\Util\Metadata\Metadata,
	Clio\Component\Util\Metadata\SchemaMetadata
;


/**
 * MetadataRebuilder 
 *    Rebuilder is a tool to bind "state", or "inject relative component" 
 *    into unserialized metadata.
 *
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataRebuilder extends Invoker
{
	public function __construct(Injector $injector)
	{
		$this->injector = $injector;
	}

	public function doInvokeArgs(array $args)
	{
		$metadata = array_shift($args);

		if(!$metadata instanceof Metadata) {
			throw new \InvalidArgumentException('MetadataRebuilder::doInvokeArgs requires Metadata, but "%s" is given.', is_object($metadata) ? get_class($metadata) : gettype($metadata));
		}

		foreach($metadata->getMappings() as $mapping) {
			$this->injector->inject($mapping, false);
		}

		if($metadata instanceof SchemaMetadata) {
			foreach($metadata->getFields() as $field) {
				foreach($field->getMappings() as $mapping) {
					$this->injector->inject($mapping);
				}
			}
		}

		return $metadata;
	}
}

