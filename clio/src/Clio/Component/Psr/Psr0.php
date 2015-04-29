<?php
namespace Clio\Component\Psr;

/**
 * Psr0 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
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

