<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity\Factory;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory\ClientProviderFactory,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\Factory\UserProviderFactory
;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity\ClientProvider,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity\UserProvider,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity\ScopeManager
;
/**
 * ManagerFactory 
 * 
 * @uses ClientProviderFactory
 * @uses UserProviderFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ManagerFactory implements ClientProviderFactory, UserProviderFactory 
{
	/**
	 * doctrine 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $doctrine;

	/**
	 * __construct 
	 * 
	 * @param mixed $doctrine 
	 * @access public
	 * @return void
	 */
	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function createClientProvider($connectTo, array $options = array())
	{
		return new ClientProvider($this->getDoctrine()->getManager($connectTo), $options['class']);
	}

	public function createUserProvider($connectTo, array $options = array())
	{
		return new UserProvider($this->getDoctrine()->getManager($connectTo), $options['class']);
	}

	public function createScopeProvider($connectTo, array $options = array())
	{
		return new ScopeManager($this->getDoctrine()->getManager($connectTo), $options['class']);
	}
    
    /**
     * Get doctrine.
     *
     * @access public
     * @return doctrine
     */
    public function getDoctrine()
    {
        return $this->doctrine;
    }
    
    /**
     * Set doctrine.
     *
     * @access public
     * @param doctrine the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDoctrine($doctrine)
    {
        $this->doctrine = $doctrine;
        return $this;
    }
}

