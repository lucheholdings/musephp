<?php
namespace Clio\Component\Literal;

/**
 * Psr0 
 *   
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Psr0
{
	/**
	 * convertPathToClass
	 * 
	 * @param mixed $path Filepath
	 * @param mixed $namespace Base namespace
	 * @param mixed $basepath Namespace root direcctory path
	 * @static
	 * @access public
	 * @return void
	 */
	static public function convertPathToClass($path, $baseNamespace = null)
	{

		$filename = basename($path, '.php');
		$dir = dirname($path);
		
		$namespace = '\\' . trim(str_replace(DIRECTORY_SEPARATOR, '\\', $dir), '\\');

		if($baseNamespace) {
			$namespace = '\\' . $baseNamespace . $namespace;
		}

		return new \ReflectionClass($namespace . '\\' . $filename);
	}
}

