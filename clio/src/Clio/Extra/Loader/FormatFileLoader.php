<?php
namespace Clio\Extra\Loader;

use Clio\Component\Pattern\Loader\FileLoader;
use Clio\Component\Util\Format;
use Clio\Component\Util\Format\FileFormat;
use Clio\Component\Util\Locator\Locator;
use Clio\Component\Exception\UnsupportedException;

/**
 * FormatFileLoader 
 * 
 * @uses FileLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FormatFileLoader extends FileLoader
{
	/**
	 * formats 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $formats;

	public function __construct(Locator $locator, array $formats = array())
	{
		parent::__construct($locator);

		$this->formats = $formats;
	}

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

		if(!$format) {
			// 
			throw new UnsupportedException(sprintf('Resource "%s" is not supported format to load', $resource));
		}

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
			if(($format instanceof FileFormat) && $format->isValidExtension($extension)) {
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

