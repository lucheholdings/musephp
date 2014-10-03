<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Token;

use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Auth\Provider;

/**
 * AbstractToken 
 * 
 * @uses Token
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractToken implements Token
{
	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $provider;

	/**
	 * __construct 
	 * 
	 * @param Provider $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(Provider $provider)
	{
		$this->provider = $provider;
	}
    
    /**
     * getProvider 
     * 
     * @access public
     * @return void
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * setProvider 
     * 
     * @param Provider $provider 
     * @access public
     * @return void
     */
    public function setProvider(Provider $provider)
    {
        $this->provider = $provider;
        return $this;
    }
}

