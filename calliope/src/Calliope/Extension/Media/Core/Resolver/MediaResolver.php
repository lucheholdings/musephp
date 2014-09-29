<?php
namespace Calliope\Extension\Media\CoreResolver;

use Calliope\Extension\Media\CoreMediaRegistry;
use Calliope\Extension\Media\CoreModel\ContentInterface;

/**
 * MediaResolver 
 *   MediaResolver to resolve media for the Content from its type. 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MediaResolver 
{
	/**
	 * registry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $registry;

	/**
	 * __construct 
	 * 
	 * @param MediaRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(MediaRegistry $registry)
	{
		$this->registry = $registry;
	}

    /**
     * Get registry.
     *
     * @access public
     * @return registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }

	/**
	 * resolveMedia 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function resolveMedia(ContentInterface $content)
	{
		$type = $content->getType();
		$media = $this->getRegistry()->getMedia($type);

		if(!$media) {
			throw new \RuntimeException(sprintf('Media "%s" is not registered on registry.', $type));
		}

		return $media;
	}
}

