<?php
namespace Clio\Component\Tool\Serializer\Adapter;

/**
 * AdapeterFactoryInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AdapterFactoryInterface
{
	/**
	 * isSupport 
	 * 
	 * @param mixed $adaptee
	 * @access public
	 * @return void
	 */
	function isSupport($adaptee);

	/**
	 * createAdapter 
	 * 
	 * @param mixed $adaptee
	 * @access public
	 * @return void
	 */
	function createAdapter($adaptee);
}

