<?php
namespace Calliope\Extension\Media\Core\Model;

use Calliope\Framework\Core\Model\TaggableFlexibleModel;
/**
 * Content 
 * 
 * @uses TaggableFlexibleScheme
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Content extends TaggableFlexibleModel implements ContentInterface
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * url 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_url;

    /**
     * Get type.
     *
     * @access public
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set type.
     *
     * @access public
     * @param type the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
    
    /**
     * Get url.
     *
     * @access public
     * @return url
     */
    public function getUrl()
    {
        return $this->_url;
    }

	public function setUrl($url)
	{
		$this->_url = $url;
	}
	/**
	 * getMediaParameters 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMediaParameters()
	{
		return array_merge(
			$this->getAttributes()->toKeyValueArray(),
			array(
				'type' => $this->getType(),
				'created_at' => $this->getCreatedAt(),
				'updated_at' => $this->getUpdatedAt(),
				'hash' => $this->getHash(),
			)
		);
	}
}

