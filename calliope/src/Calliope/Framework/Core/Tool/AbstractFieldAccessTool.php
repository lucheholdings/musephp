<?php
namespace Calliope\Framework\Core\Tool;

use Clio\Component\Pce\Metadata\ClassMetadata;

/**
 * AbstractFieldAccessTool 
 * 
 * @uses SchemeTool
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFieldAccessTool extends AbstractTool
{
	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadata;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadata $metadata 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $metadata)
	{
		$this->classMetadata = $metadata;

		if(!$this->classMetadata->hasMapping('field_accessor')) {
			//
			throw new \RuntimeException('%s required "field_accessor" mapping on ClassMetadata.');
		}
	}

	/**
	 * getFieldAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldAccessor()
	{
		return $this->getClassMetadata()->getMapping('field_accessor')->getAccessor();
	}
    
    /**
     * Get classMetadata.
     *
     * @access public
     * @return classMetadata
     */
    public function getClassMetadata()
    {
        return $this->classMetadata;
    }
    
    /**
     * Set classMetadata.
     *
     * @access public
     * @param classMetadata the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadata($classMetadata)
    {
        $this->classMetadata = $classMetadata;
        return $this;
    }
}

