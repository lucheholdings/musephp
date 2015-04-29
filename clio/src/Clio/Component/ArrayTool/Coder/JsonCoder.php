<?php
namespace Clio\Component\ArrayTool\Coder;

/**
 * JsonCoder 
 * 
 * @uses Encoder
 * @uses Decoder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class JsonCoder implements Encoder, Decoder 
{
	/**
	 * maxDepth 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $maxDepth;

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
	 * @param array $options 
	 * @param int $maxDepth 
	 * @access public
	 * @return void
	 */
	public function __construct($options = 0, $maxDepth = 512)
	{
		$this->maxDepth = $maxDepth;
		$this->options  = $options;
	}

	/**
	 * encode 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function encode(array $data)
	{
		if (version_compare(PHP_VERSION, '5.5.0') >= 0) {
			return json_encode($data, $this->getOptions(), $this->getMaxDepth());
		} else if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
			return json_encode($data, $this->getOptions());
		} else {
			return json_encode($data);
		}
	}

	/**
	 * decode 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function decode($data)
	{
		if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
			return json_decode($data, true, $this->getMaxDepth(), $this->getOptions());
		} else if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
			return json_decode($data, true, $this->getMaxDepth());
		} else {
			return json_decode($data, true);
		}
	}
    
    /**
     * getMaxDepth 
     * 
     * @access public
     * @return void
     */
    public function getMaxDepth()
    {
        return $this->maxDepth;
    }
    
    /**
     * setMaxDepth 
     * 
     * @param mixed $maxDepth 
     * @access public
     * @return void
     */
    public function setMaxDepth($maxDepth)
    {
        $this->maxDepth = $maxDepth;
        return $this;
    }
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     *   json_encode/json_decode options 
     * @param int $options 
     * @access public
     * @return void
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}

