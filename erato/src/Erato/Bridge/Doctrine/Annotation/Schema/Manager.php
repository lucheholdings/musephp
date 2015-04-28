<?php
namespace Erato\Bridge\Doctrine\Annotation\Schema;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Manager 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target("CLASS")
 */
class Manager extends BaseAnnotation implements SchemaMappingAnnotation 
{
	/**
	 * factory 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $factory;
    
    /**
     * getFactory 
     * 
     * @access public
     * @return void
     */
    public function getFactory()
    {
        return $this->factory;
    }
    
    /**
     * setFactory 
     * 
     * @param mixed $factory 
     * @access public
     * @return void
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
        return $this;
    }

	/**
	 * getClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClass()
	{
		return $this->getValue();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'services' => array(
				'factory'       => $this->getFactory(),
			),
			'manager_class' => $this->getClass(),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'schema_manager'
		);
	}
}
