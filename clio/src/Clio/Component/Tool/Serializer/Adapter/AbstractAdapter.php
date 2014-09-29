<?php
namespace Clio\Component\Tool\Serializer\Adapter;

use Clio\Component\Tool\Serializer\SerializationFormats;
use Clio\Component\Tool\Serializer\SerializerInterface,
	Clio\Component\Tool\Serializer\DeserializerInterface;

/**
 * AbstractAdapter 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractAdapter 
  implements 
      SerializationAdapterInterface,
      DeserializationAdapterInterface
{
	/**
	 * adaptee 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $adaptee;

	/**
	 * __construct 
	 * 
	 * @param mixed $adaptee 
	 * @access public
	 * @return void
	 */
	public function __construct($adaptee)
	{
		$this->adaptee = $adaptee;
	}

	/**
	 * getFormatFromContentType 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function getFormatFromContentType($type)
	{
		$contentTypes = $this->getSupportedTypeMaps();
		if(!isset($contentTypes[$type])) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Unsupported contentType "%s"', $type));
		}

		return $contentTypes[$type];
	}
	
	/**
	 * isSupoprtFormat 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function isSupportedFormat($format)
	{
		return in_array($format, $this->getSupportedFormats());
	}

	/**
	 * isFormatAsContentType 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function isSupportedContentType($type)
	{
		return in_array($type, $this->getSupportedContentTypes());
	}

	/**
	 * getSupportedContentTypes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSupportedContentTypes()
	{
		return array_keys($this->getSupportedTypeMaps());
	}

	/**
	 * getSupportedFormats 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getSupportedFormats()
	{
		return array_unique(array_values($this->getSupportedTypeMaps()));
	}

	/**
	 * getSupportedTypeMaps 
	 * 
	 * @abstract
	 * @access public
	 * @return void
	 */
	abstract public function getSupportedTypeMaps();
	//{
	//	return static $contentTypes = array(
	//		'application/json' => SerializationFormats::FORMAT_JSON,
	//		'application/xml'  => SerializationFormats::FORMAT_XML,
	//	);
	//}
    
    /**
     * Get adaptee.
     *
     * @access public
     * @return adaptee
     */
    public function getAdaptee()
    {
        return $this->adaptee;
    }
    
    /**
     * Set adaptee.
     *
     * @access public
     * @param adaptee the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAdaptee($adaptee)
    {
        $this->adaptee = $adaptee;
        return $this;
    }
}

