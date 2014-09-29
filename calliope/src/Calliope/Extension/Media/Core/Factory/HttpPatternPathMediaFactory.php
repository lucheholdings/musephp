<?php
namespace Calliope\Extension\Media\Core\Factory;

use Calliope\Extension\Media\Core\Media;
/**
 * HttpPatternPathMediaFactory 
 * 
 * @uses AbstractMediaFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpPatternPathMediaFactory implements MediaFactory 
{
	/**
	 * createMedia 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function createMedia($name, array $options = array())
	{
		return new Media\HttpPatternPathMedia($name, $options['pattern'], isset($options['defaults']) ? $options['defaults'] : array());
	}
}

