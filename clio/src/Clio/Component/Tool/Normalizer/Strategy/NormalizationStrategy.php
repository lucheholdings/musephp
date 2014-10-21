<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy;
use Clio\Component\Tool\Normalizer\Context;
/**
 * NormalizationStrategy 
 * 
 * @uses Strategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface NormalizationStrategy extends Strategy
{
	/**
	 * normalize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function normalize($data, $type = null, Context $context = null);

	/**
	 * canNormalize 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	function canNormalize($data, $type, Context $context);
}

