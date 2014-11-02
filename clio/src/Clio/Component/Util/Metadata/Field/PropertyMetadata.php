<?php
namespace Clio\Component\Util\Metadata\Field;

/**
 * PropertyMetadata 
 * 
 * @uses AbstractFieldMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyMetadata extends AbstractFieldMetadata 
{
    /**
     * getReflectionProperty 
     * 
     * @access public
     * @return void
     */
    public function getReflectionProperty()
    {
        return $this->getSchemaMetadata()->getReflectionClass()->getProperty($this->getName());
    }
}

