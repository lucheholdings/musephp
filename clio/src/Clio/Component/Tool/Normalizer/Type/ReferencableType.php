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
	 * reference 
	 *   Create ReferenceType for this type 
	 * @access public
	 * @return ReferenceType
	 */
	function reference();

	/**
	 * getIdentifierFields 
	 * 
	 * @access public
	 * @return void
	 */
	function getIdentifierFields();

	/**
	 * getIdentifierValues 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function getIdentifierValues($data);
}

