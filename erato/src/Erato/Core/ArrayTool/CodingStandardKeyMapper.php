<?php
namespace Erato\Core\ArrayTool;

use Clio\Component\Tool\ArrayTool\Mapper\Mapper;
use Erato\Core\CondingStandard;

/**
 * CodingStandardKeyMapper 
 * 
 * @uses Mapper
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class CodingStandardKeyMapper implements Mapper
{
	/**
	 * codingStandard 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $codingStandard;

	/**
	 * __construct 
	 * 
	 * @param CodingStandard $codingStandard 
	 * @access public
	 * @return void
	 */
	public function __construct(CodingStandard $codingStandard)
	{
		$this->codingStandard = $codingStandard;
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
		$cleaned = array()
		foreach($values as $key => $value) {
			$cleaned[$this->getCodingStandard()->formatNaming($this->getMapToNaming(), $key)] = $value;
		}

		return $cleaned;
	}

	/**
	 * inverseMap 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function inverseMap(array $data)
	{
		$cleaned = array()
		foreach($values as $key => $value) {
			$cleaned[$this->getCodingStandard()->formatNaming($this->getMapFromNaming(), $key)] = $value;
		}

		return $cleaned;
	}

	abstract protected function getNamingFrom();

	abstract protected function getNamingTo();

    /**
     * getCodingStandard 
     * 
     * @access public
     * @return void
     */
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    /**
     * setCodingStandard 
     * 
     * @param CodingStandard $codingStandard 
     * @access public
     * @return void
     */
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;
        return $this;
    }
}

