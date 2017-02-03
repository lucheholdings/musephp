<?php
namespace Clio\Component\Pce\Metadata;

/**
 * AbstractMapping 
 * 
 * @uses Metadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AbstractMapping implements Metadata
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
	 * @access public
	 * @return void
	 */
	public function __construct(Metadata $metadata)
	{
		$this->metadata = $metadata;
	}

    /**
     * Get metadata.
     *
     * @access public
     * @return metadata
     */
    public function getMetadata()
    {
		if(!$this->metadata) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('Mapping "%s" is not bound yet.', get_class($this)));
		}
        return $this->metadata;
    }
    
    /**
     * Set metadata.
     *
     * @access public
     * @param metadata the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }

	/**
	 * getReflector 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReflector()
	{
		return $this->getMetadata()->getReflector();
	}
}

