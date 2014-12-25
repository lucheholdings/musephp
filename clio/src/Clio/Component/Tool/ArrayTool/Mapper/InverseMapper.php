<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

/**
 * InverseMapper 
 * 
 * @uses KeyMapper
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InverseMapper implements Mapper
{
	/**
	 * mapper 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mapper;

	/**
	 * __construct 
	 * 
	 * @param Mapper $mapper 
	 * @access public
	 * @return void
	 */
	public function __construct(Mapper $mapper)
	{
		$this->mapper = $mapper;
	}

	/**
	 * map 
	 * 
	 * @param array $values 
	 * @access public
	 * @return void
	 */
	public function map(array $values)
	{
		return $this->getMapper()->inverseMap($values);
	}

	/**
	 * inverseMap 
	 * 
	 * @param array $values 
	 * @access public
	 * @return void
	 */
	public function inverseMap(array $values)
	{
		return $this->getMapper()->map($values);
	}
    
    /**
     * getMapper 
     * 
     * @access public
     * @return void
     */
    public function getMapper()
    {
        return $this->mapper;
    }
    
    /**
     * setMapper 
     * 
     * @param mixed $mapper 
     * @access public
     * @return void
     */
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
        return $this;
    }
}

