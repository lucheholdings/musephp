<?php
namespace Clio\Component\Util\Tag;

/**
 * TagContainerAccessor 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerAccessor 
{
	/**
	 * tagFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tagFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(TagFactory $tagFactory = null)
	{
		$this->tagFactory = $tagFactory;
	}

	/**
	 * createTag 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function createTag($name)
	{
		// Create Tag Instance
		return $this->getTagFactory()->createTag($name);
	}

	public function add(TagContainer $container, $name)
	{
		if(!$container->has($name)) {
			$container->add($this->createTag($name));
		}
	}

	public function has(TagContainer $container, $name)
	{
		return $container->has($name);
	}
	
	public function remove(TagContainer $container, $name)
	{
		return $container->remove($name);
	}

	public function removeAll()
	{
		$container->removeAll();
	}

	public function replace(TagContainer $container, array $names)
	{
		// once remove all tags
		$addScheduleTags = array();
		$deleteScheduleTags = $container->getNameArray();

		foreach($names as $name) {
			if(false !== ($key = array_search($name, $deleteScheduleTags))) {
				// already exists.
				// unset from the deleteScheduleTags
				unset($deleteScheduleTags[$key]);
			} else {
				$addScheduleTags[$name] = $name;
			}
		}

		foreach($deleteScheduleTags as $tag) {
			$container->remove($tag);
		}

		foreach($addScheduleTags as $tag) {
			$this->add($container, $tag);
		}

		return $container;
	}
    
    /**
     * Get tagFactory.
     *
     * @access public
     * @return tagFactory
     */
    public function getTagFactory()
    {
		if(!$this->tagFactory) {
			$this->tagFactory = new TagComponentFactory('Clio\Component\Util\Tag\SimpleTag');
		}
        return $this->tagFactory;
    }
    
    /**
     * Set tagFactory.
     *
     * @access public
     * @param tagFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTagFactory($tagFactory)
    {
        $this->tagFactory = $tagFactory;
        return $this;
    }
}

