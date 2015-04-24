<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Loader\Exception as LoaderExceptions;
use Clio\Component\Pattern\Parser\Parser;

/**
 * FileLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FileLoader extends AbstractResourceLoader 
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
	public function __construct(FileLocator $locator, Parser $parser = null)
	{
		$this->locator = $locator;
        parent::__construct($parser);
	}

	/**
	 * import
	 *   Import context from file resource
	 * @param mixed $resource 
	 * @access public 
	 * @return void
	 */
	public function import($filepath)
	{
        // configure file path
		$locator = $this->getLocator();
		try {
			$path = $locator->locate($filepath, true);
		} catch(\InvalidArgumentException $ex) {
			// File is not located.
			throw new LoaderExceptions\ResourceNotFoundException(sprintf('Resource "%s" is not found.', $filepath), 0, $ex);
		}
		
		// Import the file with file format 
		return $this->doImport($path);
	}

    /**
     * doImport
     *   Parse file format 
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
}
