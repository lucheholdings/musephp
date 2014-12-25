<?php
namespace Erato\Core\ArrayTool;

use Erato\Core\CodingStandard;

/**
 * PropertyToArrayKeyMapper 
 * 
 * @uses CodingStandardKeyMapper
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PropertyToArrayKeyMapper extends CodingStandardKeyMapper 
{
	public function __construct($standard)
	{
		parent::__construct($standard, CodingStandard::NAMING_PROPERTY, CodingStandard::NAMING_ARRAY_FIELD);
	}
}

