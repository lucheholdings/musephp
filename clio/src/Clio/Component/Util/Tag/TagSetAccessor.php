<?php
namespace Clio\Component\Util\Tag;

/**
 * TagSetAccessor 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetAccessor implements TagSetAccessorInterface 
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
		if(!$tagFactory) {
			$tagFactory = new TagComponentFactory('Clio\Component\Util\Tag\SimpleTag');
		}
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

	public function add(TagSet $container, $name)
	{
		if(!$container->containsName($name)) {
			$tag = $this->createTag($name);
			$tag->setOwner($container->getOwner());
			$container->add($tag);
		}
	}

	public function has(TagSet $container, $name)
	{
		return $container->containsName($name);
	}
	
	public function remove(TagSet $container, $name)
	{
		return $container->remove($name);
	}

	public function removeAll(TagSet $container)
	{
		$container->removeAll();
	}

	public function replace(TagSet $container, array $names)
	{
		// once remove all tags
		$addScheduleTags = array();
		$deleteScheduleTags = $container->getNameArray();

		foreach($names as $name) {
			if(false !== ($key = array_search($name, $deleteScheduleTags))) {
				// already exists.
				// unset from the deleteScheduleTags
				unset($deleteScheduleTags[$key]);
			} else if(!empty($name)) {
				$addScheduleTags[(string)$name] = $name;
			}
		}

		foreach($deleteScheduleTags as $tag) {
			$container->removeByName($tag);
		}

		foreach($addScheduleTags as $tag) {
			$this->add($container, $tag);
		}

		return $container;
	}

	public function getNames(TagSet $container)
	{
		$names = array();
		foreach($container as $tag) {
			$names[] = $tag->getName();
		}
		return $names;
	}
    
    /**
     * Get tagFactory.
     *
     * @access public
     * @return tagFactory
     */
    public function getTagFactory()
    {
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

