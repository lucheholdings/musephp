<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Model\ContentInterface;

/**
 * HttpPatternPathMedia
 *   HttpPatternPath Media is a media with generatable patterned url.
 * 
 * ex)
 *   pattern = "/images/{size}/{hash}.jpg"
 *   pattern = "http://image.server.com/{server_id}/{size}/{hash}.{format}"
 * 
 *   {foo} will be replaced with option keys "foo"
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpPatternPathMedia extends AbstractMedia implements HttpMedia 
{
	/**
	 * pattern 
	 *    
	 * @var mixed
	 * @access private
	 */
	private $pattern;

	/**
	 * defaults 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaults;

	/**
	 * __construct 
	 * 
	 * @param mixed $pattern 
	 * @access public
	 * @return void
	 */
	public function __construct($name, $pattern, array $defaults = array())
	{
		parent::__construct($name);

		$this->pattern = $pattern;
		$this->defaults = $defaults;
	}

	/**
	 * generateUrl 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function generateUrl(array $options = array())
	{
		$params = array_merge($this->getDefaults(), $options['params']);
		return preg_replace_callback('/\{(?P<key>.*?)\}/i', function($matches) use ($params){
				if(isset($params[$matches['key']])) {
					return $params[$matches['key']];
				} else {
					return '';
				}
			}, $this->pattern);
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
		if(!isset($options['params'])) {
			$options['params'] = array();
		}
		$options['params'] = array_merge($options['params'], $content->getMediaParameters());
		return $this->generateUrl($options);
	}
    
    /**
     * Get pattern.
     *
     * @access public
     * @return pattern
     */
    public function getPattern()
    {
        return $this->pattern;
    }
    
    /**
     * Set pattern.
     *
     * @access public
     * @param pattern the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }
    
    /**
     * Get defaults.
     *
     * @access public
     * @return defaults
     */
    public function getDefaults()
    {
        return $this->defaults;
    }
    
    /**
     * Set defaults.
     *
     * @access public
     * @param defaults the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
        return $this;
    }

	/**
	 * validateMediaContent 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function validateMediaContent(ContentInterface $content)
	{
		parent::validateMediaContent($content);

		$missingKeys = array();
		$enableKeys = array_keys(array_merge($this->getDefaults(), $content->getMediaParameters()));

		$matches = array();
		if(preg_match_all('/\{(?P<key>.*?)\}/i', $this->getPattern(), $matches)) {
			foreach($matches['key'] as $match) {
				if(!in_array($match, $enableKeys)) {
					$missingKeys = $match;
				}
			}
		}

		if(!empty($missingKeys)) {
			throw new \Exception(sprintf('Missing required keys %s for media "%s"', json_encode($missingKeys), $this->getName()));
		}
	}
}

