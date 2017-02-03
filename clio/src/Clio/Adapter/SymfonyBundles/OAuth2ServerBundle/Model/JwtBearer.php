<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class JwtBearer implements JwtBearerInterface
{
	/**
	 * publicId 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $publicId;

	/**
	 * clientId 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $clientId;

	/**
	 * subject 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $subject;

	/**
	 * getPublicId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getPublicId()
	{
		return $this->publicId;
	}

	/**
	 * setPublicId 
	 * 
	 * @param mixed $publicId 
	 * @access public
	 * @return void
	 */
	public function setPublicId($publicId)
	{
		$this->publicId = $publicId;
	}

	/**
	 * getClientId 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClientId()
	{
		return $this->clientId;
	}

	/**
	 * setClientId 
	 * 
	 * @param mixed $clientId 
	 * @access public
	 * @return void
	 */
	public function setClientId($clientId)
	{
		$this->clientId = $clientId;
	}

	/**
	 * getSubject 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * setSubject 
	 * 
	 * @param mixed $subject 
	 * @access public
	 * @return void
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
}

