<?php
namespace Clio\Component\Tool\Normalizer;

interface Type 
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

