<?php
namespace Clio\Extra\Builder;

use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Pattern\Builder\Builder;

/**
 * SchemaBuilder 
 * 
 * @uses Builder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaBuilder implements Builder 
{
	/**
	 * schema 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schema;

	/**
	 * parameters 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parameters;

	/**
	 * __construct 
	 * 
	 * @param Schema $schema 
	 * @access public
	 * @return void
	 */
	public function __construct($schema)
	{
		$this->parameters = array();
		$this->schema = $schema;
	}

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		return $this->getSchema()->getMapping('normalizer')->denormalize($this->all());
	}

	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($key)
	{
		return isset($this->parameters[$key]);
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value) 
	{
		$this->parameters[$key] = $value;
		return $this;
	}

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		return $this->parameters[$key];
	}

	/**
	 * remove 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function remove($key)
	{
		unset($this->parameters[$key]);
		return $this;
	}

	/**
	 * all 
	 * 
	 * @access public
	 * @return void
	 */
	public function all()
	{
		return $this->parameters;
	}

	/**
	 * addParameters 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function addParameters(array $params)
	{
		foreach($params as $key => $value) {
			$this->set($key, $value);
		}
		return $this;
	}

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		$this->parameters = array();
		return $this;
	}
    
    public function getSchema()
    {
        return $this->schema;
    }
    
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }
}

