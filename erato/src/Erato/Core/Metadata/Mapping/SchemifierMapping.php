<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\AbstractMapping;

/**
 * SchemifierMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemifierMapping extends AbstractMapping
{
	/**
	 * type 
	 *   Schemifier type 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * fieldKeyMappers 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldKeyMappers;

	/**
	 * getSchemifier 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemifier()
	{
		if(!$this->schemifier) {
			$builder = new SchemifierBuidler();
			$bulider
				->setType($this->type)
				->setSchema($this->getSchemifierSchema())
				->setOptions($this->options)
			;

			$this->schemifier = $builder->build();
		}
		return $this->schemifier;
	}

	/**
	 * getSchemifierSchema 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemifierSchema()
	{
		if(!$this->schemifierSchema) {
			if($this->getMetadata() instanceof ClassMetadata) {
				$this->schemifierSchema = new ClassSchema($this->getMetadata()->getClassReflector());
			} else {
				// fixme
				throw new \Exception('Not Impl');
			}
		}

		return $this->schemifierSchema;
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'schemifier';
	}
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


	public function serialize()
	{

	}

	public function unserialize()
	{
	}
}

