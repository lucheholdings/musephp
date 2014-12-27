<?php
namespace Erato\Core\Tool;

use Clio\Component\Util\Metadata\SchemaMetadata;

/**
 * AccessorReplacer 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AccessorReplacer 
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
	 * replace 
	 * 
	 * @param mixed $origin
	 * @param mixed.. replace resources
	 * @access public
	 * @return void
	 */
	public function replace($origin)
	{
		$resources = func_get_args();

		array_shift($resources);
		
		while(0 < count($resources)) {
			$origin = $this->doReplace($origin, array_shift($resources));
		}

		return $origin;
	}

	/**
	 * doReplace 
	 * 
	 * @param mixed $origin 
	 * @param mixed $source 
	 * @access protected
	 * @return void
	 */
	protected function doReplace($origin, $source)
	{
		$classMetadata = $this->getSchemaMetadata();

		if(!$classMetadata->isSchemaData($origin)) {
			throw new \InvalidArgumentException(sprintf('The instance of origin is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($origin) ? get_class($origin) : gettype($origin)));
		}
		if(!$classMetadata->isSchemaData($source)) {
			throw new \InvalidArgumentException(sprintf('The instance for source is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($source) ? get_class($source) : gettype($source)));
		}

		$accessor = $this->getAccessor();

		// get property names
		$ignores = $this->ignoreFields;
		$deleteFields = array_filter($accessor->getFieldNames($origin), function($field) use ($ignores) {
			return !in_array($field, $ignores);
		});

		foreach($accessor->getFieldValues($source) as $field => $value) {
			if(!in_array($field, $this->ignoreFields)) {
				$accessor->set($origin, $field, $value);

				if(false !== ($idx = array_search($field, $deleteFields))) {
					unset($deleteFields[$idx]);
				}
			}
		}

		foreach($deleteFields as $field) {
			if(!in_array($field, $this->ignoreFields)) {
				$accessor->clear($origin, $field);
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
		return $this->getSchemaMetadata()->getMapping('accessor')->getAccessor();
	}
}

