<?php
namespace Erato\Core\Metadata\Mapping;

use Clio\Extra\Metadata\Mapping\AbstractRegistryServiceMapping;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Pattern\Registry\Registry;

/**
 * SchemifierMapping 
 * 
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemifierMapping extends AbstractRegistryServiceMapping
{
	/**
	 * fieldKeyMappers 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldKeyMappers;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @param Registry $registry 
	 * @param mixed $schemifieryId 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, Registry $registry, $schemifierFactoryId, array $options = array())
	{
		parent::__construct($metadata, $registry, array('factory' => $schemifierFactoryId), $options);
	}

	/**
	 * getSchemifier 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemifier()
	{
		if(!$this->schemifier) {
			$this->getService('factory')->createSchemifier($this->getSchemifierSchema(), $this->options);
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
				throw new \Exception('Not Impl yet');
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
    
	public function serialize(array $extra = array())
	{
		$extra['mappers'] = $this->fieldKeyMappers;

		return parent::serialize($extra);
	}

	public function unserialize($serialized)
	{
		$extra = parent::unserialize($serialized);

		$this->fieldKeyMappers = $extra['mappers'];
		unset($extra['mappers']);

		return $extra;
	}
}

