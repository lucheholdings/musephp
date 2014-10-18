<?php
namespace Clio\Component\Util\Accessor;

use Clio\Component\Util\Accessor\Field\FieldAccessorCollection;

/**
 * SimpleClassAccessor 
 * 
 * @uses FieldAccessorCollection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleClassAccessor extends FieldAccessorCollection implements SchemaAccessor
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
	 * classReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classReflector;

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
		$this->classReflector = $classReflector;

		parent::__construct($accessors);
	}
    
    /**
     * getClassReflector 
     * 
     * @access public
     * @return void
     */
    public function getClassReflector()
    {
        return $this->classReflector;
    }
    
    /**
     * setClassReflector 
     * 
     * @param mixed $classReflector 
     * @access public
     * @return void
     */
    public function setClassReflector($classReflector)
    {
        $this->classReflector = $classReflector;
        return $this;
    }
}

