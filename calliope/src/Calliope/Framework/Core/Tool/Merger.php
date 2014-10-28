<?php
namespace Calliope\Framework\Core\Tool;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Merger\ScalarMerger;
/**
 * Merger 
 *   Merger metadata attributes with given metadata
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Merger extends AbstractFieldAccessTool
{
	static protected $defaultIgnoreFields = array('hash', '_accessor');

	static private $defaultMerger;
	
	private $fieldMergers = array();

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
	public function merge()
	{
		$metadatas = func_get_args();
		if(2 > count($metadatas)) {
			throw new \InvalidArgumentException('Merger::merge requires more than 2 parameters to merge.');
		}

		$target = array_shift($metadatas);
		while($source = array_shift($metadatas)) {
			$target = $this->doMerge($target, $source);
		}

		return $target;
	}

	/**
	 * doMerge 
	 * 
	 * @param mixed $target 
	 * @param mixed $source 
	 * @access protected
	 * @return void
	 */
	protected function doMerge($target, $source)
	{
		$classMetadata = $this->getClassMetadata();

		if(!$classMetadata->isInstance($target)) {
			throw new \InvalidArgumentException(sprintf('The instance of target is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($target) ? get_class($target) : gettype($target)));
		}
		if(!$classMetadata->isInstance($source)) {
			throw new \InvalidArgumentException(sprintf('The instance for source is not a valid instance of "%s", but "%s" is given', $classMetadata->getClass(), is_object($source) ? get_class($source) : gettype($source)));
		}

		$accessor = $this->getFieldAccessor();

		foreach($accessor->getFields($source) as $field => $value) {
			if(!in_array($field, $this->ignoreFields)) {
				if(method_exists($target, 'merge'. ucfirst($field))) {
					$method = 'merge' . ucfirst($field);
					$target->$method($value);
				} else if($value) {
					// Get FieldMerger
					$baseValue = null;
					if(!$accessor->isNull($target, $field)) {
						$baseValue= $accessor->get($target, $field);
						$value = $this->getFieldMerger($field)->merge($baseValue, $value);
					} 
					$accessor->set($target, $field, $value);
				}
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
		return call_user_func_array(array($this, 'merge'), $args);
	}
    
    public function getFieldMerges()
    {
        return $this->fieldMergers;
    }
    
    public function setFieldMerges($fieldMergers)
    {
        $this->fieldMergers = $fieldMergers;
        return $this;
    }

	public function getFieldMerger($field)
	{
		if(array_key_exists($field, $this->fieldMergers)) {
			return $this->fieldMergers[$field];
		}

		if(!self::$defaultMerger) {
			self::$defaultMerger = new ScalarMerger();
		}
		return self::$defaultMerger;
	}
}

