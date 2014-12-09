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
	public function serialize(array $extra = array())
	{
		return serialize(array(
			$this->getOptions(),
			$extra
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		list(
			$this->options,
			$extra
		) = $data;
		// do nothing
		$this->metadata = null;

		return $extra;
	}
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	public function setOption($key, $value)
	{
		$this->options[$key] = $value;
		return $this;
	}

	public function getOption($key)
	{
		return $this->options[$key];
	}

	public function mergeOptions(array $options)
	{
		$this->options = $this->doMergeOptions($this->options, $options);
	}

	protected function doMergeOptions($first, $second)
	{
		if(!is_array($first)) {
			return $second;
		}

		foreach($second as $key => $value) {
			if(!isset($first[$key])) {
				$first[$key] = $value;
			} else if(is_scalar($first[$key]) || is_scalar($value)) {
				$first[$key] = $value;
			} else {
				$first[$key] = $this->doMergeOptions($first[$key], $value);
			}
		}
		
		return $first;
	}

	public function dumpConfig()
	{
		return array(
			'options' => $this->getOptions()
		);
	}
}

