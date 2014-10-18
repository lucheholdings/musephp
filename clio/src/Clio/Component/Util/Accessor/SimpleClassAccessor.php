<?php
namespace Clio\Component\Util\Accessor;

/**
 * SimpleClassAccessor 
 * 
 * @uses AbstractSchemaAccessor 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleClassAccessor extends AbstractSchemaAccessor
{
	/**
	 * createDefaultAccessor 
	 *   Create ClassAccessor with Default FieldAccessors
	 *   such as 
	 *     - PublicPropertyFieldAccessor
	 *     - MethodFieldAccessor 
	 * 
	 * @param mixed $class 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createDefaultAccessor($class)
	{
		static $factory = null;
		if(!$factory) {
			$factory = new BasicClassAccessorFactory();
		}

		return $factory->createClassAccessor($class);
	}

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param array $accessors 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $classReflector, array $accessors = array(), array $options = array())
	{
		parent::__construct($classReflector, $accessors);
	}
    
    /**
     * getClassReflector 
     * 
     * @access public
     * @return void
     */
    public function getClassReflector()
    {
        return $this->getSchema();
    }
    
    /**
     * setClassReflector 
     * 
     * @param mixed $classReflector 
     * @access public
     * @return void
     */
    public function setClassReflector(\ReflectionClass $classReflector)
    {
		return $this->setSchema($classReflector);
    }
}

