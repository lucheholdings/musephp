<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Clio\Component\Util\Container\Container;
use Doctrine\Common\Collections\Collection;

use Clio\Bridge\Doctrine\Container\ProxyMap;

use JMS\Serializer\VisitorInterface,
	JMS\Serializer\Context
;

/**
 * DoctrineAttributeMap 
 *    
 * @uses DoctrineProxyContainerHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineMapHandler extends DoctrineProxyContainerHandler 
{
	static protected $containerTypes = array(
		'DoctrineMap', 'Clio\Bridge\Doctrine\Container\ProxyMap'
	);	

	/**
	 * decorateCollection 
	 * 
	 * @param Collection $container 
	 * @access public
	 * @return void
	 */
	protected function decorateCollection(Collection $collection)
	{
		return new ProxyMap($collection);
	}

	/**
	 * containerToArray 
	 * 
	 * @param Container $container 
	 * @access protected
	 * @return void
	 */
	protected function containerToArray(Container $container)
	{
		return $container->getKeyValueArray();
	}

    /**
     * deserializeContainer 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $data 
     * @param array $type 
     * @param mixed $context 
     * @access public
     * @return void
     */
    public function deserializeContainer(VisitorInterface $visitor, $data, array $type, Context $context)
	{
		$innerType = $type;
		$innerType['name'] = 'array';

		foreach($data as $key => $value) {
			if(!is_array($value)) {
				$data[$key] = array('key' => $key, 'value' => $value);
			} else {
				if(!isset($value['key'])) {
					$data[$key]['key'] = $key;
				}

				if(!isset($value['value'])) {
					unset($data[$key]);
				}
			}
		}
		return parent::deserializeContainer($visitor, $data, $innerType, $context);
	}
}

