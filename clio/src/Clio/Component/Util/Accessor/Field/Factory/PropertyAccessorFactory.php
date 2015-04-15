<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field\Factory as FieldAccessorFactory;
use Clio\Component\Util\Accessor\Field as FieldAccessors;
use Clio\Component\Util\Metadata;

/**
 * PropertyAccessorFactory 
 * 
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PropertyAccessorFactory implements FieldAccessorFactory 
{
    /**
     * createFieldAccessor 
     * 
     * @param Metadata\Field $field 
     * @param array $options 
     * @access public
     * @return void
     */
    public function createFieldAccessor(Metadata\Field $field, array $options = array())
    {
        if($field->getReflector()->isPublic()) {
            // 
            return new FieldAccessors\PublicPropertyAccessor($field->getName(), $field->getReflector());
        } else {
            // Try to figure getter/setter
            $getter = $this->guessPropertyGetter($field, $options);
            $setter = $this->guessPropertySetter($field, $options);

            if($getter || $setter) {
                return new FieldAccessors\MethodPropertyAccessor($field->getName(), $getter, $setter);
            }
        }

        throw new \RuntimeException('Unsupported field to create Accessor.');
    }

    /**
     * guessPropertyGetter 
     * 
     * @param Metadata\Field $field 
     * @param array $options 
     * @access protected
     * @return void
     */
    protected function guessPropertyGetter(Metadata\Field $field, array $options = array())
    {
        $getters = array(
                'get' . ucfirst($field->getName()),
                'is' . ucfirst($field->getName()),
            );
        foreach($getters as $getter) {
            if($field->getReflector()->getDeclaringClass()->hasMethod($getter)) {
                return $field->getReflector()->getDeclaringClass()->getMethod($getter);
            }
        }
        // no method match
        return null;
    }

    /**
     * guessPropertySetter 
     * 
     * @param Metadata\Field $field 
     * @param array $options 
     * @access protected
     * @return void
     */
    protected function guessPropertySetter(Metadata\Field $field, array $options = array())
    {
        $getters = array(
                'set' . ucfirst($field->getName()),
            );
        foreach($getters as $getter) {
            if($field->getReflector()->getDeclaringClass()->hasMethod($getter)) {
                return $field->getReflector()->getDeclaringClass()->getMethod($getter);
            }
        }
        // no method match
        return null;
    }

    public function canCreateFieldAccessor(Metadata\Field $field, array $options = array())
    {
        if($field->getReflector()->isPublic()) {
            // 
            return true;
        } else {
            // Try to figure getter/setter
            $getter = $this->guessPropertyGetter($field, $options);
            $setter = $this->guessPropertySetter($field, $options);

            if($getter || $setter) {
                return true;
            }
        }
        return false;
    }
}
