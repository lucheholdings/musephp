<?php
namespace Calliope\Extension\Media\Core;

use Calliope\Extension\Media\Core\Media;
use Calliope\Framework\Core\SchemaProviderInterface;

use Calliope\Framework\Extension\ProxySchemaProvider;
/**
 * TypeFilterContentProvider 
 * 
 * @uses ProxySchemaProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypeFilterContentProvider extends ProxySchemaProvider  
{
	/**
	 * media 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $media;

	/**
	 * __construct 
	 * 
	 * @param Media $media 
	 * @param SchemaProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaProviderInterface $provider, Media $media)
	{
		parent::__construct($provider);

		$this->media = $media;
	}

	/**
	 * findBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @param mixed $limit 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
		$criteria['type'] = $this->getMedia()->getName();
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }


	/**
	 * findOneBy 
	 * 
	 * @param array $criteria 
	 * @param array $orderBy 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
    {
		$criteria['type'] = $this->getMedia()->getName();
		return parent::findOneBy($criteria, $orderBy);
    }


	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria)
    {
		$criteria['type'] = $this->getMedia()->getName();
		return parent::countBy($criteria);
    }
    
    
    /**
     * Get media.
     *
     * @access public
     * @return media
     */
    public function getMedia()
    {
        return $this->media;
    }
    
    /**
     * Set media.
     *
     * @access public
     * @param media the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setMedia(Media $media)
    {
        $this->media = $media;
        return $this;
    }
}

