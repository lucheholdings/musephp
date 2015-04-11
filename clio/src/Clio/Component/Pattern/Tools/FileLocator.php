<?php
namespace Clio\Component\Pattern\Tools;

/**
 * FileLocator 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FileLocator 
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
     * @access protected
     * @return void
     */
    protected function isAbsolutePath($file)
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

	/**
	 * locate 
	 * 
	 * @param mixed $name 
	 * @param mixed $first 
	 * @access public
	 * @return void
	 */
	public function locate($name, $first = true)
	{
        if (empty($name)) {
            throw new \InvalidArgumentException('An empty file name is not valid to be located.');
        }

        if ($this->isAbsolutePath($name)) {
            if (!file_exists($name)) {
                throw new \InvalidArgumentException(sprintf('The file "%s" does not exist.', $name));
            }

            return $name;
        }

        $filepaths = array();

        foreach ($this->roots as $root) {
            if (file_exists($file = $root . DIRECTORY_SEPARATOR . $name)) {
                if (true === $first) {
                    return $file;
                }
                $filepaths[] = $file;
            }
        }

        if (!$filepaths) {
            throw new \InvalidArgumentException(sprintf('The file "%s" does not exist (in: %s).', $name, implode(', ', $this->roots)));
        }

        return array_values(array_unique($filepaths));
	}
}

