<?php
namespace Clio\Extra\Loader;

use Clio\Component\Util\Format;
use Clio\Component\Util\FileFormat;

/**
 * FormatFileLoader 
 * 
 * @uses FileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FormatLoader extends FileLoader
{
	/**
	 * formats 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $formats;

	/**
	 * load 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return void
	 */
	public function load($resource)
	{
		$format = $this->resolveFormat($resource);

		// if line breaks not exists, then might be file name 
		if(false === strpos("\n", $resource) && $this->getLocator()) {
			$resource = $this->importFile($resource);
		}

		return $format->parse($resource);
	}

	/**
	 * resolveFormat 
	 *   Guess the format from file extension 
	 * 
	 * @param mixed $resource 
	 * @access public
	 * @return bool|Format
	 */
	public function resolveFormat($resource)
	{
		$extension = pathinfo($resource, PATHINFO_EXTENSION);

		// 
		foreach($this->formats as $format) {
			if(($format instanceof FileFormat) && $format->validExtension($extension)) {
				return $format;
			}
		}

		return false;
	}

	/**
	 * addFormat 
	 * 
	 * @param Format $format 
	 * @access public
	 * @return void
	 */
	public function addFormat(Format $format)
	{
		$this->formats[] = $format;
		return $this;
	}

	/**
	 * removeFormat 
	 * 
	 * @param Format $format 
	 * @access public
	 * @return void
	 */
	public function removeFormat(Format $format)
	{
		$this->formats = array_filter($this->formats, function($v){
			return $format !== $v;
		});
	}

	/**
	 * getFormats 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFormats()
	{
		return $this->formats;
	}
}

