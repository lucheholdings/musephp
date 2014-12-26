<?php
namespace Clio\Component\Tool\Normalizer\Type;

/**
 * ReferencableType 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ReferencableType
{
	/**
	 * canReference 
	 *   Validate this type can referred or not. 
	 * @access public
	 * @return bool
	 */
	function canReference();

	/**
	 * reference 
	 *   Create ReferenceType for this type 
	 * @access public
	 * @return ReferenceType
	 */
	function reference();

}

