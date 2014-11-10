<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\GraphNavigator;

use Clio\Component\Util\Tag\TagSet;

/**
 * TagSetHandler 
 * 
 * @uses KeyValueContainerHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class TagSetHandler extends SetHandler
{
    /**
     * getSubscribingMethods 
     * 
     * @static
     * @access public
     * @return void
     */
    public static function getSubscribingMethods()
    {
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        $collectionTypes = array('TagSet', 'Clio\Component\Util\Tag\TagSet');

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeContainer',
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeContainer',
                );
            }
        }

        return $methods;
    }

	/**
	 * wrapContainer 
	 * 
	 * @param array $collection 
	 * @access protected
	 * @return void
	 */
	protected function wrapContainer(array $data, $itemClass)
	{
		$collection = new SimpleTagSet();

		return $collection;
	}

	/**
	 * getDefaultItemClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getDefaultItemClass()
	{
		return 'Clio\Component\Util\Tag\SimpleTag';
	}
}
