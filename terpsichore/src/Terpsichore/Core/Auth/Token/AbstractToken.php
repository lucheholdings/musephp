<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token as TokenInterface;
use Terpsichore\Core\Auth\User as UserInterface;
use Terpsichore\Core\Auth\Provider as ProviderInterface;

/**
 * AbstractToken 
 * 
 * @uses TokenInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractToken implements TokenInterface
{

	private $provider;

	public function __construct($provider)
	{
		$this->provider = $provider;
	}
    
    public function getProvider()
    {
        return $this->provider;
    }
    
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }
}

