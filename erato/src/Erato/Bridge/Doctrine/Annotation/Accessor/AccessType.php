<?php
namespace Erato\Bridge\Doctrine\Annotation\Accessor;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * AccessType 
 *   AccessType("property") 
 *   AccessType("method", getter="getMethod", setter="setMethod") 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target("PROPERTY")
 */
class AccessType extends BaseAnnotation implements FieldMappingAnnotation 
{
	/**
	 * getter 
	 * 
	 * @var string
	 * @access protected
	 */
	protected $getter;

	/**
	 * setter 
	 * 
	 * @var string
	 * @access protected
	 */
	protected $setter;

    
    public function getGetter()
    {
        return $this->getter;
    }
    
    public function setGetter($getter)
    {
        $this->getter = $getter;
        return $this;
    }
    
    public function getSetter()
    {
        return $this->setter;
    }
    
    public function setSetter($setter)
    {
        $this->setter = $setter;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		$configs = array(
			'type'   => $this->getValue(),
		);
		if($this->getGetter()) {
			$configs['getter'] = $this->getGetter();
		}
		if($this->getSetter()) {
			$configs['setter'] = $this->getSetter();
		}

		return $configs;
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
