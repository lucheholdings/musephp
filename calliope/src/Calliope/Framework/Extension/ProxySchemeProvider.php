<?php
namespace Calliope\Framework\Extension;

use Calliope\Framework\Core\SchemeProviderInterface;

/**
 * ProxySchemeProvider 
 * 
 * @uses SchemeProviderInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxySchemeProvider implements SchemeProviderInterface 
{
	/**
	 * reference
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reference;

	/**
	 * __construct 
	 * 
	 * @param SchemeProviderInterface $reference 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemeProviderInterface $reference)
	{
		$this->reference = $reference;
	}

	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->getReference()->findBy($criteria, $orderBy, $limit, $offset);
    }


	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
    {
        return $this->getReference()->findOneBy($criteria, $orderBy);
    }


	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria)
    {
        return $this->getReference()->countBy($criteria);
    }
    
    /**
     * Get reference.
     *
     * @access public
     * @return reference
     */
    public function getReference()
    {
        return $this->reference;
    }
    
    /**
     * Set reference.
     *
     * @access public
     * @param reference the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
}

