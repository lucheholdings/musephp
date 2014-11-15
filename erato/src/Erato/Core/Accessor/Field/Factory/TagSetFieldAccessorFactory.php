<?php
namespace Erato\Core\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Field\Factory\AbstractFieldAccessorFactory;
use Clio\Component\Util\Tag\TagSetAware,
	Clio\Component\Util\Tag\TagSetAccessor,
	Clio\Component\Util\Tag\TagComponentFactory
;
use Erato\Core\Accessor\Field\TagSetFieldAccessor;
use Erato\Core\Accessor\Schema\ReflectionClassAwarable;

/**
 * TagSetFieldAccessorFactory 
 * 
 * @uses AbstractFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetFieldAccessorFactory extends AbstractFieldAccessorFactory 
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
	public function createFieldAccessor(Field $field, array $options = array())
	{
		if(!$this->tagFactory) {
			$tagClass = null;
			if(isset($options['tag_class'])) {
				$tagClass = $options['tag_class'];
			}
			$this->tagFactory = new TagComponentFactory($tagClass);
		}
		return new TagSetFieldAccessor($this->createTagAccessor($this->getTagFactory()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField(Field $field)
	{
		if(($field->getSchema() instanceof ReflectionClassAwarable) && ($field->getName() == $this->getTagFieldName()) && ($field->getSchema()->getReflectionClass() instanceof TagSetAware)) {
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
		return new TagSetAccessor($factory);
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
