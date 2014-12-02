<?php
namespace Clio\Component\Util\Locator;

/**
 * AbstractLocator 
 * 
 * @uses Locator
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractLocator implements Locator 
{
	/**
	 * roots 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $roots;

	/**
	 * __construct 
	 * 
	 * @param array $paths 
	 * @access public
	 * @return void
	 */
	public function __construct($paths = array())
	{
		$this->roots = (array) $paths;
	}

	/**
	 * roots 
	 *   now locator is with new additional roots. 
	 * 
	 * @param mixed $dirs 
	 * @access public
	 * @return void
	 */
	public function roots($dirs)
	{
		$dirs = (array) $dirs;
		return new static(array_unique(array_merge($this->roots, $dirs)));
	}

	/**
	 * subs 
	 *   now locator is for the sub dirs of roots. 
	 * 
	 * @param mixed $dirs 
	 * @access public
	 * @return void
	 */
	public function subs($dirs)
	{
		$dirs = (array) $dirs;
		$newRoots = array();

		foreach($this->roots as $root) {
			foreach($dirs as $dir) {
				$path = $root . DIRECTORY_SEPARATOR . ltrim($dir, DIRECTORY_SEPARATOR);

				if(file_exists($path) && is_dir($path)) {
					$newRoots[] = $path;
				}
			}
		}

		return new static(array_unique($newRoots));
	}

    /**
     * isAbsolutePath 
     * 
     * @param mixed $file 
     * @access private
     * @return void
     */
    private function isAbsolutePath($file)
    {
        if ($file[0] === '/' || $file[0] === '\\'
            || (strlen($file) > 3 && ctype_alpha($file[0])
                && $file[1] === ':'
                && ($file[2] === '\\' || $file[2] === '/')
            )
            || null !== parse_url($file, PHP_URL_SCHEME)
        ) {
            return true;
        }

        return false;
    }
}

