<?php
namespace Calliope\Framework\Core\Exception;

/**
 * DuplicateException 
 * 
 * @uses Exception
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DuplicateException extends ResourceException 
{
	/**
	 * table 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $table;

	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * __construct 
	 * 
	 * @param mixed $table 
	 * @param array $fields 
	 * @param int $code 
	 * @param mixed $prev 
	 * @access public
	 * @return void
	 */
	public function __construct($table, array $fields = array(), $code = 0, $prev = null)
	{
		$this->table = $table;
		$this->fields = $fields;

		parent::__construct(array('table' => $table, 'fields' => $fields), $code, $prev);
	}

	/**
	 * formatMessage 
	 * 
	 * @param array $params 
	 * @access protected
	 * @return void
	 */
	protected function formatMessage(array $params = array())
	{
		if(isset($params['table'])) {
			if(isset($params['fields'])) {
				return sprintf('%s: Resource already exists %s.', $params['table'], json_encode($params['fields']));
			} else {
				return sprintf('%s: Resource already exists.', $params['table']);
			}
		} 

		return 'Resource already exists.';
	}
    
    /**
     * Get table.
     *
     * @access public
     * @return table
     */
    public function getTable()
    {
        return $this->table;
    }
    
    /**
     * Set table.
     *
     * @access public
     * @param table the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }
    
    /**
     * Get fields.
     *
     * @access public
     * @return fields
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * Set fields.
     *
     * @access public
     * @param fields the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFields($fields)
    {
        $this->fields = $fields;
        return $this;
    }
}

