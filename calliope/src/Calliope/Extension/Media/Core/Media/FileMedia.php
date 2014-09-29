<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Media;
use Clio\Component\IO\Locator\LocatorInterface;

/**
 * FileMedia 
 * 
 * @uses Media
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FileMedia implements Media 
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
	 * @param LocatorInterface $locator 
	 * @access public
	 * @return void
	 */
	public function __construct(LocatorInterface $locator)
	{
		$this->locator = $locator;
	}
    
    /**
     * Get locator.
     *
     * @access public
     * @return locator
     */
    public function getLocator()
    {
        return $this->locator;
    }
    
    /**
     * Set locator.
     *
     * @access public
     * @param locator the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLocator($locator)
    {
        $this->locator = $locator;
        return $this;
    }

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'file';
	}
}

