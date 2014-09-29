<?php
namespace Calliope\Extension\Media\DoctrineOrm\Entity\MappedSuperclass;

use Calliope\Extension\Media\Core\Model\ContentInterface;
use Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass\TaggableFlexibleModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *   MappedSuperclass of Media Content Entity
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass()
 */
abstract class Content extends TaggableFlexibleModel implements ContentInterface
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="type", type="string")
	 */
	protected $type;

	/**
	 * url 
	 *   Url of the media type.
	 *   Might be a url, fileurl, or media id of the service
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $_url;
    
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
    
    /**
     * Set url.
     *
     * @access public
     * @param url the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

	public function getMediaParameters()
	{
		return array_merge(
			$this->getAttributes()->getKeyValueArray(),
			array(
				'hash' => $this->getHash(),
				'type' => $this->getType(),
				'created_at' => $this->getCreatedAt(),
				'updated_at' => $this->getUpdatedAt(),
			)
		);
	}
}
