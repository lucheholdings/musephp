<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory;

use Clio\Component\Pattern\Factory\FactoryMap;

/**
 * TokenResolverFactoryMap 
 * 
 * @uses FactoryMap
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenResolverFactoryMap extends FactoryMap  
{
	/**
	 * creaetTokenResolver 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createTokenResolver($type, array $options = array())
	{
		if(!$this->hasKey($type)) {
			throw new \InvalidArgumentException(sprintf('Invalid TokenResolver type "%s", choose one from [%s]', $type, implode(',', $this->getKeys())));
		}

		return $this->createByKeyArgs($type, $options);
	}

	/**
	 * doCreate 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate($type, array $args)
	{
		return $this->get($type)->createTokenResolver($type, $args);
	}

	/**
	 * getValidatedFactoryClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getValidatedFactoryClass()
	{
		return 'Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory';
	}

}

