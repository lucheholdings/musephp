<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Doctrine\Common\Collections\Collection;
use Clio\Component\Util\Container\Container;
use Clio\Bridge\Doctrine\Container\ProxyAttributeMap;
/**
 * DoctrineAttributeContainer 
 *    
 * @uses DoctrineProxyCollectionHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineSetHandler extends DoctrineProxyContainerHandler 
{
	static protected $containerTypes = array(
		'DoctrineSet', 'Clio\Bridge\Doctrine\Container\ProxySet'
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
		return new ProxySet($collection);
	}

	/**
	 * collectionToArray 
	 * 
	 * @param Container $container
	 * @access protected
	 * @return void
	 */
	protected function containerToArray(Container $container)
	{
		return $container->getScalarValues();
	}
}

