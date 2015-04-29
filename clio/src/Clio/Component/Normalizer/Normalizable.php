<?php
namespace Clio\Component\Normalizer;

/**
 * Normalizable 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Normalizable
{
	/**
	 * normalize 
	 * 
	 * @access public
	 * @return void
	 */
	function normalize();

	/**
	 * denormalize 
	 * 
	 * @param array $normalized 
	 * @access public
	 * @return void
	 */
	function denormalize(array $normalized);
}

