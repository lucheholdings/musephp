<?php
namespace Clio\Component\Util\Accessor\Schema\Factory;

use Clio\Component\Util\Accessor\Schema\ClassSchema,
	Clio\Component\Util\Accessor\Schema\ArraySchema
;
use Clio\Component\Util\Accessor\Schema\AccessorFactory;

/**
 * GuessNamedAccessorFactory 
 * 
 * @uses AbstractFactory
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GuessNamedAccessorFactory extends AbstractNamedAccessorFactory 
{
	/**
	 * accessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessorFactory;

	/**
	 * __construct 
	 * 
	 * @param AccessorFactory $accessorFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(AccessorFactory $accessorFactory)
	{
		$this->accessorFactory = $accessorFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createSchemaAccessorByName($name, array $options = array())
	{
		$schema = $this->guessSchemaFromName($name);
		return $this->getAccessorFactory()->createSchemaAccessor($schema, $options);
	}

	/**
	 * guessSchema 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function guessSchemaFromName($name)
	{
		$schema = null;
		switch($name) {
		case 'array':
			$schema = new ArraySchema();
			break;
		default:
			if(class_exists($name)) {
				// ClassSchema
				$schema = new ClassSchema(new \ReflectionClass($name));
			}
			break;
		}

		return $schema;
	}
    
    /**
     * getAccessorFactory 
     * 
     * @access public
     * @return void
     */
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    /**
     * setAccessorFactory 
     * 
     * @param AccessorFactory $accessorFactory 
     * @access public
     * @return void
     */
    public function setAccessorFactory(AccessorFactory $accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }
}

