<?php
namespace Clio\Bridge\Doctrine\Metadata\Mapping\Factory;

class AttributeMapAwareMappingFactory extends BaseFactory
{
	private $annotationReader;
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(AnnotationReader $annotationReader)
	{
		$this->annotationReader = $annotationReader;
	}

	/**
	 * loadMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function loadMapping(Metadata $metadata, array $options = array())
	{
		$mapping = $this->getAnnotationReader()->getClassAnnotation('Clio\Bridge\Doctrine\Mapping\AttributeMapAware');

		if(!$mapping) {
			$mapping = parent::loadMapping($metadata, $options);
		}

		return $mapping;
	}
    
    /**
     * Get annotationReader.
     *
     * @access public
     * @return annotationReader
     */
    public function getAnnotationReader()
    {
        return $this->annotationReader;
    }
    
    /**
     * Set annotationReader.
     *
     * @access public
     * @param annotationReader the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAnnotationReader($annotationReader)
    {
        $this->annotationReader = $annotationReader;
        return $this;
    }
}

