<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Field\NamedField;
/**
 * ClassSchema 
 * 
 * @uses ReflectionClassAwarable
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassSchema implements Schema, ReflectionClassAwarable 
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $reflectionClass 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $reflectionClass)
	{
		$this->reflectionClass = $reflectionClass;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFields()
	{
		if(!$this->fields) {
			$this->fields = array();

			foreach($this->getReflectionClass()->getProperties() as $property) {
				$this->fields[] = new NamedField($this, $property->getName());
			}
		}

		return $this->fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSchemaData($data)
	{
		return $this->getReflectionClass()->isInstance($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isReflectionClassAwared()
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getReflectionClass()
	{
		return $this->reflectionClass;
	}
}
