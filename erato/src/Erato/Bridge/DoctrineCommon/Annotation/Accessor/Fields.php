<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Accessor;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Fields 
 *   Fields(ignore_default="true") 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target("CLASS")
 * 
 */
class Fields extends BaseAnnotation implements SchemaMappingAnnotation 
{
	/**
	 * defaultIgnore 
	 * 
	 * @var bool
	 * @access public
	 */
	public $defaultIgnore;
    
    public function getDefaultIgnore()
    {
        return $this->defaultIgnore;
    }
    
    public function setDefaultIgnore($defaultIgnore)
    {
        $this->defaultIgnore = $defaultIgnore;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'default_ignore' => true
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'accessor'
		);
	}
}
