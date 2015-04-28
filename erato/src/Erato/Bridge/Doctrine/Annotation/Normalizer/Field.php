<?php
namespace Erato\Bridge\Doctrine\Annotation\Normalizer;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Field 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 *
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Field extends BaseAnnotation implements FieldMappingAnnotation 
{
	private $compact;

    public function getCompact()
    {
        return $this->compact;
    }
    
    public function setCompact($compact)
    {
        $this->compact = (bool)$compact;
        return $this;
    }

	/**
	 * getType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getType()
	{
		return $this->getValue();
	}

	/**
	 * getConfigs 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConfigs()
	{
		return array(
			'type'    => $this->getType(),
			'compact' => $this->getCompact(),
		);
	}

	/**
	 * getTargetMappings 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTargetMappings()
	{
		return array(
			'normalizer',
		);
	}
}

