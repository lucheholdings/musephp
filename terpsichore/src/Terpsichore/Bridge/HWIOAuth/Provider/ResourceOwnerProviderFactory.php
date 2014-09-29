<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Bridge\HWIOAuth\Provider;

use Clio\Component\Pattern\Factory\Factory;
use Clio\Component\Pattern\Factory\CompositeTypedFactory;

use Terpsichore\Core\Auth\Provider\ProviderFactory as ProviderFactoryInterface;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\Token\PreAuthenticateToken;

use Terpsichore\Bridge\HWIOAuth\ResourceOwnerFactory;
/**
 * ResourceOwnerProviderFactory 
 * 
 * @uses BaseFactory
 * @uses ProviderFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ResourceOwnerProviderFactory extends CompositeTypedFactory implements ProviderFactoryInterface 
{
	private $resourceOwnerFactory;

	public function __construct($resourceOwnerFactory)
	{
		$this->resourceOwnerFactory = $resourceOwnerFactory;
	}

	public function createForToken(Token $token)
	{
		if($token instanceof PreAuthenticateToken) {
			return $this->createByType($token->getProvider(), $token->getOptions());
		} else {
			return $token->getProvider();
		}
	}

	protected function doCreateByType($type, array $args)
	{
		// Create ResourceOwner for Type
		//$factory = $this->getFactory($type);

		//if($factory instanceof Factory) {
		//	return $factory->createArgs($args);
		//} else {
		//	return $this->createArgs($args);
		//}

		$options = $args[0];

		$resourceOwner = $this->getResourceOwnerFactory()->createResourceOwner($type, $options);

		return new ResourceOwnerProvider($resourceOwner, $options);
	}
    
    public function getResourceOwnerFactory()
    {
        return $this->resourceOwnerFactory;
    }
    
    public function setResourceOwnerFactory(ResourceOwnerFactory $resourceOwnerFactory)
    {
        $this->resourceOwnerFactory = $resourceOwnerFactory;
        return $this;
    }
}

