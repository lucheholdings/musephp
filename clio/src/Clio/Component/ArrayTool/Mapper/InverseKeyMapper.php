<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\ArrayTool\Mapper;

/**
 * InverseKeyMapper 
 * 
 * @uses KeyMapper
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InverseKeyMapper extends KeyMapper 
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
		return parent::inverseMap($values);
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
		return parent::map($values);
	}
}

