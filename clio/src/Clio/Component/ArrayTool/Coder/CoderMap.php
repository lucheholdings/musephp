<?php
namespace Clio\Component\ArrayTool\Coder;

use Clio\Component\Container\Map\SimpleMap;


/**
 * CoderMap 
 * 
 * @uses Encoder
 * @uses Decoder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CoderMap extends SimpleMap implements Encoder, Decoder
{
    /**
     * encode 
     * 
     * @param array $data 
     * @param mixed $format 
     * @access public
     * @return void
     */
	public function encode(array $data, $format = null)
	{
		if(!$format)
			throw new \InvalidArgumentException('NamedCoderCollection::encode requires $format to specify encoder.');

		return $this->get($format)->encode($data);
	}

    /**
     * decode 
     * 
     * @param mixed $data 
     * @param mixed $format 
     * @access public
     * @return void
     */
	public function decode($data, $format = null)
	{
		if(!$format)
			throw new \InvalidArgumentException('NamedCoderCollection::decode requires $format to specify encoder.');

		return $this->get($format)->decode($data);
	}
}

