<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory;

use Clio\Component\Pattern\Factory\NamedCollection;
use Clio\Component\Validator\SubclassValidator;

/**
 * TokenResolverFactoryMap 
 * 
 * @uses NamedCollection 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenResolverFactoryMap extends NamedCollection 
{
	protected function initFactory()
	{
		$this->getStorage()->setValueValidator(new SubclassValidator('Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Token\Resolver\Factory'));
	}

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
		if(!$this->has($type)) {
			throw new \InvalidArgumentException(sprintf('Invalid TokenResolver type "%s", choose one from [%s]', $type, implode(',', $this->getKeys())));
		}

		return $this->createByKeyArgs($type, array($options));
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

