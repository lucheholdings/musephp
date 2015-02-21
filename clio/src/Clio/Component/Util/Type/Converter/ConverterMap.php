<?php
namespace Clio\Component\Util\Type\Converter;

use Clio\Component\Util\Type\Converter;
use Clio\Component\Util\Type\Type;

use Clio\Component\Exception\UnsupportedException;

/**
 * ConevrterMap 
 * 
 * @uses Converter
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConevrterMap implements Converter 
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->converters = new SimpleMap();
	}

	/**
	 * addConverter 
	 * 
	 * @param Converter $converter 
	 * @access public
	 * @return void
	 */
	public function addConverter(Converter $converter)
	{
		$src  = (string)$converter->getSourceType();
		$dest = (string)$converter->getDestinationType();

		if(!$this->converters->hasKey($src)) {
			$this->converters->set($src, new SimpleMap());
		}

		$this->converters[$src][$dest] = $converter;
	}

	/**
	 * getConverter 
	 * 
	 * @param mixed $from 
	 * @param mixed $to 
	 * @access public
	 * @return void
	 */
	public function getConverter($from, $to)
	{
		if($this->converters[$form]) {
			return $this->converters[$from][$to];
		}

		throw new \OutOfBoundsException(sprintf('Converter from "%s" to "%s" is not exists.', $from, $to));
	}

	/**
	 * convert 
	 * 
	 * @param Type $from 
	 * @param Type $to 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function convert(Type $from, Type $to, $data)
	{
		if(!$from->isValidData($data)) {
			throw new \InvalidArgumentException('Data is not a valid data for source type.');
		}

		// 1st try convert with converter.
		$converter = null;
		try {
			$converter = $this->getConverter($from, $to);
		} catch(\OutOfBoundsException $ex) {
			// no converter supported to convert.
		}

		if($converter)
			return $converter->convert($data);
		
		// 2nd if no converter support conversion, try Type::convertData.
		if($from instanceof Convertable) {
			try {
				return $from->convertData($data, $to);
			} catch(UnsupportedException $ex) {
				throw new UnsupportedException(sprintf('Converter dose not support conversion from Type "%s" to Type "%s".', $from->getName(), $to->getName()), 0, $ex);
			}
		}

		throw new UnsupportedException(sprintf('Converter dose not support conversion from Type "%s" to Type "%s".', $from->getName(), $to->getName()));
	}
}

