<?php
namespace Clio\Component\Util\Metadata\Schema;

/**
 * ArraySchemaMetadata 
 * 
 * @uses AbstractMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArraySchemaMetadata extends AbstractSchemaMetadata
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function __construct($name, array $fields = array())
	{
		$this->name = $name;
		
		parent::__construct($fields);
	}
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}

