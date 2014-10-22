<?php
namespace Clio\Component\Util\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Pattern\Factory\FactoryCollection as BaseFactoryCollection;
use Clio\Component\Util\Container\Validator\ClassValidator;

/**
 * FactoryCollection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FactoryCollection extends BaseFactoryCollection 
{
	/**
	 * createTypeMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function createTypeMapping(Metadata $metadata, $type)
	{
		return $this->createByKey($type, $metadata);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function initFactory()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\Mapping\Factory'));
	}
}

