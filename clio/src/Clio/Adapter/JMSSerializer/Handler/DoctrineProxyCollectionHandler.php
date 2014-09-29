<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Handler\ArrayCollectionHandler;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Context;

class DoctrineProxyCollectionHandler extends ArrayCollectionHandler
{
	static protected $collectionTypes = array('DoctrineProxyCollection', 'Clio\Bridge\Doctrine\Container\ProxyCollection');

	public static function getSubscribingMethods()
	{
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        $collectionTypes = static::$collectionTypes;

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeCollection',
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeCollection',
                );
            }
        }

        return $methods;
	}


    /**
     * serializeCollection 
     * 
     * @param VisitorInterface $visitor 
     * @param Collection $collection 
     * @param array $type 
     * @param Context $context 
     * @access public
     * @return void
     */
    public function serializeCollection(VisitorInterface $visitor, Collection $collection, array $type, Context $context)
    {
        // We change the base type, and pass through possible parameters.
        $type['name'] = 'array';

        return $visitor->visitArray($this->collectionToArray($collection), $type, $context);
    }

    /**
     * deserializeCollection 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $data 
     * @param array $type 
     * @param Context $context 
     * @access public
     * @return void
     */
    public function deserializeCollection(VisitorInterface $visitor, $data, array $type, Context $context)
    {
		$arrayCollection = parent::deserializeCollection($visitor, $data, $type, $context);

		return $this->decorateCollection($arrayCollection);
    }

	/**
	 * decorateCollection 
	 * 
	 * @param Collection $collection 
	 * @access public
	 * @return void
	 */
	protected function decorateCollection(Collection $collection)
	{
		return new ProxyCollection($collection);
	}

	/**
	 * collectionToArray 
	 * 
	 * @param Collection $collection 
	 * @access protected
	 * @return void
	 */
	protected function collectionToArray(Collection $collection)
	{
		return $collection->toArray();
	}

}

