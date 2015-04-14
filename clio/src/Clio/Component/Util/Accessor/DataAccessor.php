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

        if(is_scalar($data) || is_array($data)) {
            $data = new Tool\Scalar($data);
        }
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
        $this->tryInitData();
        // Push $this->data as first argument
        array_unshift($args, $this->data);

        // Call SchemaAccessor method
        return call_user_func_array(array($this->getSchemaAccessor(), $method), $args);
    }

    public function tryInitData()
    {
        if(!$this->data) {
            $schema = $this->getSchemaAccessor()->getSchema();

            if($schema->isType('null')) {
                return ;
            }
            
            if($schema->isType('class')) {
                // instantiate
                $this->data = $schema->newInstance();
            } else {
                $this->data = new Tool\Scalar();
            }
        }
    }
    
    /**
     * getData 
     * 
     * @access public
     * @return void
     */
    public function getData()
    {
        $this->tryInitData();

        if($this->data instanceof Tool\Scalar) {
            return $this->data->raw;
        }
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
        if(is_scalar($data) || is_array($data)) {
            $data = new Tool\Scalar($data);
        }
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

    /**
     * getSchema 
     * 
     * @access public
     * @return void
     */
    public function getSchema()
    {
        return $this->getSchemaAccessor()->getSchema();
    }
}

