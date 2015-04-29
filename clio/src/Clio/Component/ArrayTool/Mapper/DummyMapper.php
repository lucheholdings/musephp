<?php
namespace Clio\Component\ArrayTool\Mapper;

/**
 * DummyMapper 
 * 
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DummyMapper implements Mapper 
{
    /**
     * map 
     * 
     * @param array $values 
     * @access public
     * @return void
     */
	public function map(array $values)
	{
		return $values;
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
		return $values;
	}
}

