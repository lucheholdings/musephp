<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Loader\Exception as LoaderExceptions;

/**
 * FileLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FileLoader implements Loader 
{
	/**
	 * locator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $locator;

	/**
	 * __construct 
	 * 
	 * @param FileLocator $locator 
	 * @access public
	 * @return void
	 */
	public function __construct(FileLocator $locator)
	{
		$this->locator = $locator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($resource)
	{
		return $this->loadFile($resource);
	}

	/**
	 * import
	 * 
	 * @param mixed $resource 
	 * @access protected
	 * @return void
	 */
	protected function import($file)
	{
        // configure file path
		$locator = $this->getLocator();
		try {
			$path = $locator->locate($file, true);
		} catch(\InvalidArgumentException $ex) {
			// File is not located.
			throw new LoaderExceptions\ResourceNotFoundException(sprintf('Resource "%s" is not found.', $file), 0, $ex);
		}
		
		// Import the file with file format 
		return $this->doImport($path);
	}

    /**
     * doImport
     * 
     * @param mixed $path 
     * @access protected
     * @return void
     */
	protected function doImport($path)
	{
		return file_get_contents($path);
	}
    
    /**
     * getLocator 
     * 
     * @access public
     * @return void
     */
    public function getLocator()
    {
        return $this->locator;
    }
    
    /**
     * setLocator 
     * 
     * @param Locator $locator 
     * @access public
     * @return void
     */
    public function setLocator(FileLocator $locator)
    {
        $this->locator = $locator;
        return $this;
    }

    /**
     * canLoad 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
	public function canLoad($resource)
	{
        try {
	        $path = $locator->locate($file, true);
        } catch(\InvalidArgumentException $ex) {
            return false;
        }
		return true;
	}
}

