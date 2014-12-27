<?php
namespace Calliope\Framework\Core\Tool;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
/**
 * Replace
 *   Replace metadata attributes with given metadata
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Replacer extends AbstractFieldAccessTool
{
	static protected $defaultIgnoreFields = array('id', 'attributes', 'createdAt', 'updatedAt', '_tags');

	/**
	 * ignoreFields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ignoreFields;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadata $classMetadata 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $classMetadata, array $ignoreFields = null)
	{
		parent::__construct($classMetadata);

		if($ignoreFields) {
			$this->ignoreFields = $ignoreFields;
		} else {
			$this->ignoreFields = self::$defaultIgnoreFields;
		}
	}

	/**
	 * merge 
	 * 
	 * @access public
	 * @return void
	 */
	public function replace($target, $source)
	{
		$classMetadata = $this->getClassMetadata();

		if(!$classMetadata->isInstance($target)) {
			throw new \InvalidArgumentException(sprintf('The instance of target is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($target) ? get_class($target) : gettype($target)));
		}
		if(!$classMetadata->isInstance($source)) {
			throw new \InvalidArgumentException(sprintf('The instance for source is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($source) ? get_class($source) : gettype($source)));
		}

		// 
		$accessor = $this->getFieldAccessor();

		// get property names
		$ignores = $this->ignoreFields;
		$deleteFields = array_filter($accessor->getFieldNames($target), function($field) use ($ignores) {
			return !in_array($field, $ignores);
		});

		foreach($accessor->getFields($source) as $field => $value) {
			if(!in_array($field, $this->ignoreFields)) {
				$accessor->set($target, $field, $value);

				if(false !== ($idx = array_search($field, $deleteFields))) {
					unset($deleteFields[$idx]);
				}
			}
		}

		foreach($deleteFields as $field) {
			if(!in_array($field, $this->ignoreFields)) {
				$accessor->clear($target, $field);
			}
		}

		return $target;
	}

	/**
	 * addIgnoreField 
	 * 
	 * @param mixed $fields 
	 * @access public
	 * @return void
	 */
	public function addIgnoreField($fields)
	{
		if(is_array($fields)) {
			foreach($fields as $field) {
				$this->addIgnoreField($field);
			}
		} else if(!in_array($fields, $this->ignoreFields)) {
			$this->ignoreFields[] = $fields;
		}
	}

	/**
	 * removeIgnoreField 
	 * 
	 * @param mixed $fields 
	 * @access public
	 * @return void
	 */
	public function removeIgnoreField($fields)
	{
		if(is_array($fields)) {
			foreach($fields as $field) {
				$this->removeIgnoreField($field);
			}
		} else if($pos = array_search($fields, $this->ignoreFields)) {
			unset($this->ignoreFields[$pos]);
		}
	}

	/**
	 * doInvoke 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doInvoke(array $args)
	{
		return call_user_func_array(array($this, 'replace'), $args);
	}
}

