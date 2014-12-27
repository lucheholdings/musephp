<?php
namespace Erato\Core\Tool;

use Clio\Component\Util\Metadata\SchemaMetadata;

/**
 * AccessorMerger 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AccessorMerger 
{
	private $schemaMetadata;

	private $ignoreFields;

	/**
	 * __construct 
	 * 
	 * @param SchemaMetadata $schemaMetadata 
	 * @param array $ignoreFields 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadata $schemaMetadata, array $ignoreFields = array())
	{
		$this->schemaMetadata = $schemaMetadata;
		$this->ignoreFields = $ignoreFields;
	}

	/**
	 * merge 
	 * 
	 * @param mixed $origin
	 * @param mixed.. merge resources
	 * @access public
	 * @return void
	 */
	public function merge($origin)
	{
		$resources = func_get_args();
		array_shift($resources);
		
		while(0 < count($resources)) {
			$origin = $this->doMerge($origin, array_shift($resources));
		}

		return $origin;
	}

	/**
	 * doMerge 
	 * 
	 * @param mixed $origin 
	 * @param mixed $source 
	 * @access protected
	 * @return void
	 */
	protected function doMerge($origin, $source)
	{
		$classMetadata = $this->getClassMetadata();

		if(!$classMetadata->isSchemaData($origin)) {
			throw new \InvalidArgumentException(sprintf('The instance of target is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($origin) ? get_class($origin) : gettype($origin)));
		}
		if(!$classMetadata->isSchemaData($source)) {
			throw new \InvalidArgumentException(sprintf('The instance for source is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($source) ? get_class($source) : gettype($source)));
		}

		$accessor = $this->getAccessor();

		foreach($accessor->getFields($source) as $field => $value) {
			if(!in_array($field, $this->ignoreFields)) {
				// accept to define "mergeFieldName" method, and if it is exists, use it.
				if(method_exists($origin, 'merge'. ucfirst($field))) {
					$method = 'merge' . ucfirst($field);
					$origin->$method($value);
				} else if($value) {
					// Get FieldMerger
					$baseValue = null;
					if(!$accessor->isNull($origin, $field)) {
						$baseValue= $accessor->get($origin, $field);
						$value = $this->getFieldMerger($field)->merge($baseValue, $value);
					} 
					$accessor->set($origin, $field, $value);
				}
			}
		}

		return $origin;
	}

    /**
     * getSchemaMetadata 
     * 
     * @access public
     * @return void
     */
    public function getSchemaMetadata()
    {
        return $this->schemaMetadata;
    }

	/**
	 * getAccessor 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getAccessor()
	{
		return $This->getSchemaMetadata()->getMapping('accessor');
	}
}

