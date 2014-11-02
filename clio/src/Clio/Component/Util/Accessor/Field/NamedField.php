<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Schema;

/**
 * NamedField 
 * 
 * @uses Field
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NamedField implements Field 
{
	/**
	 * schema 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schema;

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
	 * @access public
	 * @return void
	 */
	public function __construct(Schema $schema, $name)
	{
		$this->schema = $schema;
		$this->name = $name;
	}
    
	/**
	 * {@inheritdoc}
	 */
	public function getSchema()
	{
		return $this->schema;
	}

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
}

