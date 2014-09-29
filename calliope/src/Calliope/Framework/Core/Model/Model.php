<?php
namespace Calliope\Framework\Core\Model;

use Calliope\Framework\Core\Model\TimeStampable;

/**
 * Model 
 * 
 * @uses TimeStampable
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Model implements TimeStampable 
{
	/**
	 * createdAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $createdAt;

	/**
	 * updatedAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $updatedAt;

	public function __construct()
	{
		$this->createdAt = $this->updatedAt = new \DateTime();
	}
    
    /**
     * Get createdAt.
     *
     * @access public
     * @return createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Set createdAt.
     *
     * @access public
     * @param createdAt the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * Get updatedAt.
     *
     * @access public
     * @return updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Set updatedAt.
     *
     * @access public
     * @param updatedAt the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
