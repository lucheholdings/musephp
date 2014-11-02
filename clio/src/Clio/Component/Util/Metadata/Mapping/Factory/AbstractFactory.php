<?php
namespace Clio\Component\Util\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory;
use Clio\Component\Pattern\Factory\AbstractFactory as BaseFactory;
use Clio\Component\Util\Metadata\Metadata;

/**
 * AbstractFactory 
 * 
 * @uses AbstractFactory
 * @uses Factory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFactory extends BaseFactory implements Factory 
{
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args = array())
	{
		$metadata = array_shift($args);
		$mapping = $this->createMapping($metadata);

	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @final
	 * @access public
	 * @return void
	 */
	public final function createMapping(Metadata $metadata)
	{
		$mapping = $this->doCreateMapping($metadata);

		// Inject Dependencies
		$injector = $this->getInjector();
		if($injector) {
			$injector->inject($mapping, false);
		}
		return $mapping;
	}

	/**
	 * doCreateMapping 
	 * 
	 * @param Metadata $metadata 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doCreateMapping(Metadata $metadata);

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		$metadata = array_shift($args);
		return ($metadata instanceof Metadata) && $this->isSupportedMetadata($metadata);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return true;
	}

	public function getInjector()
	{
		return null;
	}
}

