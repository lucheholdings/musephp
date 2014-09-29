<?php
namespace Calliope\Extension\Media\Core\Factory;

use Calliope\Extension\Media\Core\Media;

/**
 * DomainPathMediaFactory 
 * 
 * @uses AbstractMediaFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DomainPathMediaFactory implements MediaFactory 
{
	/**
	 * createMedia 
	 * 
	 * @param mixed $name 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMedia($name, array $options = array())
	{
		return new Media\HttpPatternPathMedia($name, 'http://{domain}/{path}', array('domain' => $options['domain']));
	}
}

