<?php
namespace Clio\Framework\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field\Factory\AbstractFieldAccessorFactory;
use Clio\Component\Util\Tag\TagContainerAware,
	Clio\Component\Util\Tag\TagContainerAccessor,
	Clio\Component\Util\Tag\TagComponentFactory
;
use Clio\Framework\Accessor\Field\TagContainerFieldAccessor;

/**
 * TagContainerFieldAccessorFactory 
 * 
 * @uses AbstractFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerFieldAccessorFactory extends AbstractFieldAccessorFactory 
{
	/**
	 * tagFieldName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tagFieldName;

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
	 * @param string $tagFieldName 
	 * @access public
	 * @return void
	 */
	public function __construct($tagFieldName = 'tags')
	{
		$this->tagFieldName = $tagFieldName;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor($schema, $fieldName, array $options = array())
	{
		if(!$this->tagFactory) {
			$tagClass = null;
			if(isset($options['tag_class'])) {
				$tagClass = $options['tag_class'];
			}
			$this->tagFactory = new TagComponentFactory($tagClass);
		}
		return new TagContainerFieldAccessor($this->createTagAccessor($this->getTagFactory()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField($schema, $fieldName)
	{
		if(($schema instanceof \ReflectionClass) && ($fieldName == $this->getTagFieldName()) && ($schema instanceof TagContainerAware)) {
			return true;
		}
		return false;
	}

	/**
	 * createTagAccessor 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createTagAccessor($factory)
	{
		return new TagContainerAccessor($factory);
	}
    
    /**
     * getTagFieldName 
     * 
     * @access public
     * @return void
     */
    public function getTagFieldName()
    {
        return $this->tagFieldName;
    }
    
    /**
     * setTagFieldName 
     * 
     * @param mixed $tagFieldName 
     * @access public
     * @return void
     */
    public function setTagFieldName($tagFieldName)
    {
        $this->tagFieldName = $tagFieldName;
        return $this;
    }
    
    public function getTagFactory()
    {
        return $this->tagFactory;
    }
    
    public function setTagFactory($tagFactory)
    {
        $this->tagFactory = $tagFactory;
        return $this;
    }
}

