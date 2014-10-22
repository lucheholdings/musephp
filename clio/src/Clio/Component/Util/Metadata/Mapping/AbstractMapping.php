<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping;

/**
 * AbstractMapping 
 * 
 * @uses Mapping
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMapping implements Mapping
{
	/**
	 * metadata 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $metadata;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata)
	{
		$this->metadata = $metadata;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return $this->getName();
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
}

