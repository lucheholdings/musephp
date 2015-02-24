<?php
namespace Clio\Component\Util\Type\Resolver;

use Clio\Component\Util\Type\Resolver;
use Clio\Component\Util\Type\FieldType;
use Clio\Component\Exception\UnsupportedException;

class FieldTypeResolver implements Resolver 
{
	/**
	 * fieldTypeResolver 
	 *   TypeResolver with decorateTypeResolver and actualTypeResolver 
	 * @var mixed
	 * @access private
	 */
	private $fieldTypeResolver;

	public function __construct(Resolver $fieldTypeResolver)
	{
		$this->fieldTypeResolver = $fieldTypeResolver;
	}

	public function resolve($type, array $options = array())
	{
		if($type instanceof FieldType) {
			$type->resolve($this->getFieldTypeResolver(), isset($options['data']) ? $options['data'] : null);

			return $type;
		}

		throw new UnsupportedException('FieldTypeResolver only support FieldType.');
	}
    
    public function getFieldTypeResolver()
    {
        return $this->fieldTypeResolver;
    }
    
    public function setFieldTypeResolver(Resolver $fieldTypeResolver)
    {
        $this->fieldTypeResolver = $fieldTypeResolver;
        return $this;
    }
}

