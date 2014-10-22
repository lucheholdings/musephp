<?php
namespace Clio\Component\Util\Metadata\Schema;

/**
 * ClassMetadata 
 * 
 * @uses AbstractSchemaMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassMetadata extends AbstractSchemaMetadata 
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $reflectionClass 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $reflectionClass, array $fields = array())
	{
		$this->reflectionClass = $reflectionClass;

		parent::__construct($fields);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getReflectionClass()->getName();
	}
}

