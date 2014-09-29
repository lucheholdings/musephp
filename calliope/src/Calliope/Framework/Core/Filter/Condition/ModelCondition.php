<?php
namespace Calliope\Framework\Core\Filter\Condition;

use Calliope\Framework\Core\Connection;

/**
 * ModelCondition 
 * 
 * @uses Condition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ModelCondition extends Condition 
{
	/**
	 * model 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $model;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, $model)
	{
		parent::__construct($connection);
		$this->model = $model;
	}
    
    /**
     * Get model.
     *
     * @access public
     * @return model
     */
    public function getModel()
    {
        return $this->model;
    }
    
    /**
     * Set model.
     *
     * @access public
     * @param model the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }
}

