<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Schema;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Schemifier 
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
class Schemifier extends BaseAnnotation implements SchemaMappingAnnotation 
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
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'services' => array(
				'factory'  => $this->getFactory(),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'schemifier'
		);
	}
}
