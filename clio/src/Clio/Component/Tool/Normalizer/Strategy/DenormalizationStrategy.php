<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Context;

/**
 * DenormalizationStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DenormalizationStrategy extends Strategy
{
	/**
	 * denormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	function denormalize($object, $type, Context $context = null);

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	function canDenormalize($object, $type, Context $context);
}

