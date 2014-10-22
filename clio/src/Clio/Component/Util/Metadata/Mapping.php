<?php
namespace Clio\Component\Util\Metadata;

interface Mapping
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * getMetadat 
	 * 
	 * @access public
	 * @return void
	 */
	function getMetadat();

	/**
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

