<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Client\Auth\Token;

use Terpsichore\Client\Auth\Token;
use Terpsichore\Client\Auth\Provider;

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
abstract class AbstractToken implements Token, \Serializable
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
	public function __construct(Provider $provider = null)
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

	/**
	 * serialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function serialize()
	{
		$data = array(
			(string)$this->getProvider(),
		);

		return serialize($data);
	}

	/**
	 * unserialize 
	 * 
	 * @param mixed $serialized 
	 * @access public
	 * @return void
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);

		list($this->provider) = $data;
	}
}

