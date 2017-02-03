<?php
namespace Application\Core\Psr;

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

	/**
	 * formatClassName 
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function formatClassName($name)
	{
		return trim(preg_replace_callback(
				'/_+(\w)/i', 
				function($matches){
					return ucfirst($matches[1]);
				}, $word), 
			'_');
	}

	/**
	 * formatMethodName
	 *   Convert to camelCase  
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function formatMethodName($name)
	{
		$acceptChars = 'a-zA-Z0-9';

		$splits = preg_split('/[^'. $acceptChars . ']+/', $name, -1, PREG_SPLIT_NO_EMPTY);

		foreach($splits as &$split) {
			$split = ucfirst($split);
		}

		return lcfirst(implode('', $splits));
	}
}

