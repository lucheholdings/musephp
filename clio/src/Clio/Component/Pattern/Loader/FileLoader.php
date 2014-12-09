<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Util\Locator\Locator;
use Clio\Component\Exception\ResourceNotFoundException;

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
	 * @param Locator $locator 
	 * @access public
	 * @return void
	 */
	public function __construct(Locator $locator)
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
	 * importFile 
	 * 
	 * @param mixed $resource 
	 * @access protected
	 * @return void
	 */
	protected function importFile($file)
	{
		$locator = $this->getLocator();
		try {
			$path = $locator->locate($file, true);
		} catch(\InvalidArgumentException $ex) {
			// File is not located.
			throw new ResourceNotFoundException(sprintf('Resource "%s" is not found.', $file), 0, $ex);
		}
		
		// Import the file with file format 
		return $this->doImportFile($path);
	}

	/**
	 * importFile 
	 * 
	 * @access public
	 * @return void
	 */
	protected function doImportFile($path)
	{
		// Unknow format, so just load the file as string.
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
    public function setLocator(Locator $locator)
    {
        $this->locator = $locator;
        return $this;
    }

	public function canLoad($resource)
	{
		return true;
	}
}

