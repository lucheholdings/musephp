<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Doctrine\Common\Collections\Collection;
use Clio\Bridge\Doctrine\Container\ProxyAttributeMap;
/**
 * DoctrineAttributeMapHandler 
 *    
 * @uses DoctrineProxyCollectionHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineAttributeMapHandler extends DoctrineMapHandler 
{
	static protected $containerTypes = array(
		'DoctrineAttributeMap', 'Clio\Bridge\Doctrine\Container\ProxyAttributeMap'
	);	

	/**
	 * decorateCollection 
	 * 
	 * @param Collection $collection 
	 * @access public
	 * @return void
	 */
	protected function decorateCollection(Collection $collection)
	{
		return new ProxyAttributeMap($collection);
	}
}

