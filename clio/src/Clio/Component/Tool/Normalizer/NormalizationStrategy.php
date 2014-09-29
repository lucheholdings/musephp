<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * NormalizationStrategy 
 * 
 * @uses NormalizerStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface NormalizationStrategy extends NormalizerStrategy
{
	/**
	 * normalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function normalize($object);

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	function canNormalize($object);
}

