<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Util\Accessor\SimpleSchemaAccessor;

/**
 * SchemaAccessorMapping 
 * 
 * @uses AccessorMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaAccessorMapping extends AccessorMapping 
{
	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	/**
	 * getAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAccessor()
	{
		if(!$this->accessor) {
			// Create SchemaAccessor with Fields
			$this->accessor = new SimpleSchemaAccessor($this);

			foreach($this->getMetadata()->getFields() as $field) {
				if($field->hasMapping('accessor')) {
					$this->accessor->addFieldAccessor($field->getMapping('accessor')->getAccessor());
				}
			}
		}

		return $this->accessor;
	}
}

