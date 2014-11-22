<?php
namespace Calliope\Core\Filter\Condition;

use Calliope\Core\Connection;
/**
 * PostFetchCondition 
 * 
 * @uses FetchCondition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PostFetchCondition extends FetchCondition 
{
	/**
	 * result 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $result;

	/**
	 * __construct 
	 * 
	 * @param mixed $connection
	 * @param mixed $result 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, $result, array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		parent::__construct($connection, $criteria, $orderBy, $limit, $offset);

		$this->result = $result;
	}
    
    /**
     * Get result.
     *
     * @access public
     * @return result
     */
    public function getResult()
    {
        return $this->result;
    }
    
    /**
     * Set result.
     *
     * @access public
     * @param result the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }
}

