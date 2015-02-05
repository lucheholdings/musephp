<?php
namespace Clio\Component\Tool\Normalizer;
use Clio\Component\Util\Type\Type;

class Scope 
{
	/**
	 * data 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $data;

	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	private $path;

	/**
	 * __construct 
	 * 
	 * @param mixed $data 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function __construct($data, Type $type, $path = '_')
	{
		$this->data = $data;
		$this->type = $type;
		$this->path = $path;
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
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType(Type $type)
    {
        $this->type = $type;
        return $this;
    }
    
    public function getPath()
    {
        return $this->path;
    }
    
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
}

