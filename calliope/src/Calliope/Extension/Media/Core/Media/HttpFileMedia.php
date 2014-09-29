<?php
namespace Calliope\Extension\Media\CoreMedia;

use Calliope\Extension\Media\Core\Model\ContentInterface;

/**
 * HttpFileMedia
 *   HttpFileMedia type is a Media 
 *   
 *   Content = {
 *     type : "file",
 *     path : <Filesystem path from root>
 *   }
 *   
 * @uses HttpMediaInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpPathMedia extends PathMedia implements HttpMedia
{
	/**
	 * baseUrl 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $baseUrl;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($domain) 
	{
		parent::__construct();

		$this->baseUrl = $baseUrl;
	}

	/**
	 * generateUrl 
	 * 
	 * @access public
	 * @return void
	 */
	public function generateUrl(array $options = array())
	{
		if(!isset($options['filepath'])) {
			throw new \InvalidArgumentException('"filepath" is required to generate Media URL.');
		}

		// check the file is located or not.
		$path = $this->getLocator()->locate($options['filepath']);
		if(!$path) {
			throw new \Exception(sprintf('File "%s" is not exists or unreadable.', $options['filepath']));
		}
		
		// if file is located, then the file is acceptable file.
		return $this->generateUrlPath($options['filepath']);
	}

	/**
	 * generateUrlPath 
	 *   Convert the relativePath to "{baseUrl}/{relativePath}" format. 
	 * 
	 * @param mixed $relativePath 
	 * @access protected
	 * @return void
	 */
	protected function generateUrlPath($relativePath)
	{
		return rtrim($this->baseUrl , '/') . '/' . ltrim($relativePath, '/');
	}

	/**
	 * generateContentUrl 
	 * 
	 * @param ContentInterface $content 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function generateContentUrl(ContentInterface $content, array $options = array())
	{
		return $this->generateUrl(array_merge($options, array('filepath' => $content->getPath())));
	}
    
    /**
     * Get baseUrl.
     *
     * @access public
     * @return baseUrl
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
    
    /**
     * Set baseUrl.
     *
     * @access public
     * @param baseUrl the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }
}

