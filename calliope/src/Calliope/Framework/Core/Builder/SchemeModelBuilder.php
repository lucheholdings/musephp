<?php
namespace Calliope\Framework\Core\Builder;

use Clio\Component\Pattern\Builder\ComponentBuilder;

use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Container\Map\Map;

/**
 * SchemeModelBuilder 
 * 
 * @uses ComponentBuilder
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeModelBuilder extends ComponentBuilder
{
	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadata;

	/**
	 * attributes 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $attributes;
	
	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadata $classMetadata, array $options = array())
	{
		parent::__construct($classMetadata->getReflectionClass());

		$this->classMetadata = $classMetadata;

		$this->attributes = new Map();
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
		if($this->getClassMetadata()->hasMapping('field_accessor')) {
			$accessor = $this->getClassMetadata()->getMapping('field_accessor')->getAccessor();

			$attrs = $this->doBuildAttributes($this->getAttributes());

			foreach($attrs as $key => $value) {
				$accessor->set($model, $key, $value);
			}
		} else {
			throw new \Exception(sprintf('Failed to build model. FieldAccessor is not initialized for the class "%s"', (string)$this->getClassMetadata()));
		}
		return parent::doBuild($model);
	}

	/**
	 * doBuildAttributes 
	 * 
	 * @param mixed $attrs 
	 * @access protected
	 * @return void
	 */
	protected function doBuildAttributes($attrs)
	{
		return $attrs;
	}

    /**
     * Get attributes.
     *
     * @access public
     * @return attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

	/**
	 * setAttribute 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->attributes[$key] = $value;
		return $this;
	}

	/**
	 * getAttribute 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key, $default = null)
	{
		return isset($this->attributes[$key]) ? $this->attributes[$key]: $default;
	}
    
    /**
     * Get classMetadata.
     *
     * @access public
     * @return classMetadata
     */
    public function getClassMetadata()
    {
        return $this->classMetadata;
    }
    
    /**
     * Set classMetadata.
     *
     * @access public
     * @param classMetadata the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadata($classMetadata)
    {
        $this->classMetadata = $classMetadata;
        return $this;
    }
}

