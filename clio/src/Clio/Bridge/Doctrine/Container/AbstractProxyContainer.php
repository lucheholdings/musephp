<?php
namespace Clio\Bridge\Doctrine\Container;
 
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Clio\Component\Util\Container\Container;

/**
 * AbstractProxyContainer 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractProxyContainer implements Container, ProxyContainer
{
	/**
	 * source 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $doctrineCollection;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineCollection $source)
	{
		$this->doctrineCollection = $source;
	}

	/**
	 * getDoctrineCollection 
	 * 
	 * @access public
	 * @return void
	 */
	public function getDoctrineCollection()
	{
		return $this->doctrineCollection;
	}

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRaw()
	{
		return $this->getDoctrineCollection();
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return $this->getDoctrineCollection()->count();
	}

    /**
     * getIterator 
     * 
     * @access public
     * @return void
     */
    public function getIterator()
	{
		return $this->getDoctrineCollection()->getIterator();
	}

	/**
	 * __clone 
	 * 
	 * @access public
	 * @return void
	 */
	public function __clone()
	{
		$this->doctrineCollection = clone $this->doctrineCollection;	
	}
}

