<?php
namespace Clio\Component\Pce\Metadata;

use Clio\Component\Util\Execution\Invoke;
/**
 * ProxyMapping 
 * 
 * @uses Mapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyMapping implements Mapping
{
	/**
	 * invoke 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $invoke;

	private $mapping;

	protected $metadata;

	/**
	 * __construct 
	 * 
	 * @param Invoke $invoke 
	 * @access public
	 * @return void
	 */
	public function __construct(Invoke $invoke)
	{
		$this->invoke = $invoke;
	}

	/**
	 * getMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMetadata()
	{
		return $this->metadata;
	}

	public function setMetadata(Metadata $metadata)
	{
		$this->metadata = $metadata;
	}

	/**
	 * getMapping 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMapping()
	{
		if(!$this->mapping) {
			$this->load();
		}

		return $this->mapping;
	}

	/**
	 * load 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function load()
	{
		$this->mapping = $this->invoke->invoke();

		if($this->mapping) {
			$this->mapping->setMetadata($this->metadata);
		}
	}

	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getMapping(), $method), $args);
	}
}

