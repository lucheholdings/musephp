<?php
namespace Clio\Extra\Normalizer\Type;

use Clio\Component\Util\Type\Type;
use Clio\Component\Util\Type\FieldType;
use Clio\Component\Util\Type\Resolver as TypeResolver;
use Clio\Extra\Normalizer\Type\NormalizerType;

/**
 * Resolver 
 * 
 * @uses TypeResolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Resolver implements TypeResolver
{
	private $baseResolver;

	/**
	 * __construct 
	 * 
	 * @param TypeResolver $baseResolver 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeResolver $baseResolver)
	{
		$this->baseResolver = $baseResolver;
	}
    
    /**
     * getBaseResolver 
     * 
     * @access public
     * @return void
     */
    public function getBaseResolver()
    {
        return $this->baseResolver;
    }
    
    /**
     * setBaseResolver 
     * 
     * @param TypeResolver $baseResolver 
     * @access public
     * @return void
     */
    public function setBaseResolver(TypeResolver $baseResolver)
    {
        $this->baseResolver = $baseResolver;
        return $this;
    }

	public function resolve($type, array $options = array())
	{
		if($type instanceof NormalizerType) {
			// only resolve internal type
			$internalType = $this->getBaseResolver()->resolve($type->getType(), $options);
			$type->setType($internalType);
		} else {
			$type = $this->getBaseResolver()->resolve($type, $options);
		}

		//if($type->isType('schema')) {
		//	$schema = $type->getSchema();
		//	if($schema && $schema->hasMapping('normalizer')) {
		//		$type = $schema->getMapping('normalizer')->getType();
		//	}
		//}

		if($type instanceof FieldType) {
			$type = new NormalizerType($type);
		}

		return $type;
	}
}

