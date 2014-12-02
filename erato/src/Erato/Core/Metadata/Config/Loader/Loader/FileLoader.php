<?php
namespace Clio\Extra\Metadata\Config\Loader;

use Clio\Component\Pattern\Loader\ParseLoader;
use Clio\Extra\Metadata\Config\Loader as ConfigLoader;

/**
 * FileLoader 
 * 
 * @uses ConfigLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FileLoader extends ParseLoader implements ConfigLoader 
{
	/**
	 * __construct 
	 *    
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function __construct($format, Parser $parser)
	{
		parent::__construct(new FormatLoader($format), $parser);
	}

	/**
	 * load 
	 * 
	 * @param mixed $classname 
	 * @access public
	 * @return void
	 */
	public function load($classname)
	{
		// convert classpath to filename
		$filename = strtr('\\', '.', $classname);

		return parent::load($filename);
	}
}

