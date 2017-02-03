<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\DoctrineExtensions\KeyValue\Entity;

use Clio\Component\Util\Pair\KeyValuePair;
use Doctrine\ORM\Mapping as ORM;

/**
 * KeyValue 
 * 
 * @uses KeyValuePair
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass()
 */
abstract class KeyValue implements KeyValuePair
{
	/**
	 * key 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 * @ORM\Column(name="`key`", type="string", nullable=false)
	 */
	protected $key;

	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="`value`", type="string")
	 */
	protected $value;

	/**
	 * __construct 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function __construct($key = null, $value = null)
	{
		$this->key = $key;
		$this->value = $vlaue;
	}
    
    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->key;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}

