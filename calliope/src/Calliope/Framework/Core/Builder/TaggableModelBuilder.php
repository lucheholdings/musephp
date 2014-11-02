<?php
namespace Calliope\Framework\Core\Builder;

/**
 * TaggableModelBuilder 
 * 
 * @uses SchemaModelBuilder
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TaggableModelBuilder extends SchemaModelBuilder 
{
	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tags;

	/**
	 * addTag 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function addTag($name)
	{
		$this->tags[] = $name;

		return $this;
	}

	/**
	 * setTags 
	 * 
	 * @param array $tags 
	 * @access public
	 * @return void
	 */
	public function setTags(array $tags)
	{
		$this->tags = array_values($tags);
		return $this;
	}

	/**
	 * getTags 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTags()
	{
		return $this->tags;
	}

	/**
	 * doBuild 
	 * 
	 * @param mixed $model 
	 * @access protected
	 * @return void
	 */
	protected function doBuild($model)
	{
		// merge $tags into attributes['tags']
		$this->set('tags', array_unique(array_merge($this->get('tags', array()), $this->tags)));

		return parent::doBuild($model);
	}
}

