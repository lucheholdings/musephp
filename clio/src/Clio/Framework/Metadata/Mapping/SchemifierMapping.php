<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Pce\Metadata\AbstractClassMapping,
	Clio\Component\Pce\Metadata\ClassMetadata;
use Clio\Component\Tool\Schemifier\Schemifier;
/**
 * SchemifierMapping 
 * 
 * @uses AbstractClassMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemifierMapping extends AbstractClassMapping 
{
	/**
	 * schemifier 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemifier;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Schemifier $schemifier)
	{
		$this->schemifier = $schemifier;
	}
    
    /**
     * Get schemifier.
     *
     * @access public
     * @return schemifier
     */
    public function getSchemifier()
    {
        return $this->schemifier;
    }
    
    /**
     * Set schemifier.
     *
     * @access public
     * @param schemifier the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchemifier($schemifier)
    {
        $this->schemifier = $schemifier;
        return $this;
    }
}

