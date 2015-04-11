<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Factory\MappedFactory;

/**
 * Factory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Factory extends MappedFactory 
{
	/**
	 * createType 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return Type 
	 */
	function createType($type, array $options = array());

    /**
     * canCreateType 
     * 
     * @param mixed $type 
     * @access public
     * @return boolean 
     */
	function canCreateType($type);
}

