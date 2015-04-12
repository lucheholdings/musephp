<?php
namespace Clio\Component\Util\Accessor;

/**
 * DataAccessor 
 *    DataAccessor 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DataAccessor implements SchemaAccessor 
{
	/**
	 * schemaAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaAccessor;

	/**
	 * data 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $data;

	/**
	 * __construct 
	 * 
	 * @param SchemaAccessor $schemaAccessor 
	 * @param object $data 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaAccessor $schemaAccessor, $data)
	{
		$this->schemaAccessor = $schemaAccessor;
		$this->data = $data;
	}

    /**
     * __call 
     * 
     * @param mixed $method 
     * @param array $args 
     * @access public
     * @return void
     */
    public function __call($method, array $args = array())
    {
        // Push $this->data as first argument
        array_unshift($args, $this->data);

        // Call SchemaAccessor method
        return call_user_func_array(array($this->getSchemaAccessor(), $method), $args);
    }
    
    /**
     * getData 
     * 
     * @access public
     * @return void
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * setData 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    /**
     * getSchemaAccessor 
     * 
     * @access public
     * @return void
     */
    public function getSchemaAccessor()
    {
        return $this->schemaAccessor;
    }
    
    /**
     * setSchemaAccessor 
     * 
     * @param mixed $schemaAccessor 
     * @access public
     * @return void
     */
    public function setSchemaAccessor($schemaAccessor)
    {
        $this->schemaAccessor = $schemaAccessor;
        return $this;
    }
}

