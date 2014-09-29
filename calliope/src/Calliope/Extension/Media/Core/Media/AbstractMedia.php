<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Media;
use Calliope\Extension\Media\Core\Model\ContentInterface;

/**
 * AbstractMedia 
 * 
 * @uses Media
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMedia implements Media, NamedMedia
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}
    
    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	/**
	 * validateContent 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function validateMediaContent(ContentInterface $content)
	{
		if($content->getType() != $this->getName()) {
			throw new \Exception('Content Type is differ from the the specified media.');
		}
	}

	/**
	 * applyMediaContent 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function applyMediaContent(ContentInterface $content)
	{
		$content->setType($this->getName());
		return $content;
	}
}

