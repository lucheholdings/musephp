<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Metadata\Metadata;
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
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * __construct 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata, array $options = array())
	{
		$this->metadata = $metadata;
		$this->options = $options;
	}

	/**
	 * {@inheritdoc}
	 */
	public function clean()
	{
		// Please override clean() if it is needed
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

	/**
	 * {@inheritdoc}
	 */
	public function setMetadata(Metadata $metadata)
	{
		$this->metadata = $metadata;
	}

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		return serialize(array(
			$this->getOptions()
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		list(
			$this->options
		) = $data;
		// do nothing
		$this->metadata = null;
	}
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}

