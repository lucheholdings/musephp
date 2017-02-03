<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * DenormalizationStrategy 
 * 
 * @uses NormalizerStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DenormalizationStrategy extends NormalizerStrategy
{
	/**
	 * denormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	function denormalize($object, $class);

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	function canDenormalize($object, $class);
}

