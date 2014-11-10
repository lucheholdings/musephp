<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Doctrine\Common\Collections\Collection;
use Clio\Bridge\Doctrine\Container\ProxyTagSet;

use JMS\Serializer\VisitorInterface,
	JMS\Serializer\Context
;
/**
 * DoctrineTagSet 
 *    
 * @uses DoctrineProxyCollectionHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineTagSetHandler extends DoctrineSetHandler
{
	static protected $containerTypes = array(
		'DoctrineTagSet', 'Clio\Bridge\Doctrine\Container\ProxyTagSet'
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
		return new ProxyTagSet($collection);
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
		$innerType['name'] = array();

		foreach($data as $key => $value) {
			if(!is_array($value)) {
				$data[$key] = $value = array('name' => $value);
			}

			if(!isset($value['name'])) {
				unset($data[$key]);
			}
		}

		return parent::deserializeContainer($visitor, $data, $innerType, $context);
	}
}

