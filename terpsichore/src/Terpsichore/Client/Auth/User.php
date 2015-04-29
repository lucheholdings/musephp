<?php
namespace Terpsichore\Client\Auth;

use Clio\Component\Container\Map\SimpleMap;

/**
 * User 
 *   Default Token User Model
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class User 
{
	/**
	 * id 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $id;

	/**
	 * {@inheritdoc}
	 */
	private $attributes;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($id, array $attrs = array())
	{
		$this->id = $id;
		$this->attributes = new SimpleMap($attrs);
	}
    
    /**
     * getId 
     * 
     * @access public
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * setId 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * getAttributes 
     * 
     * @access public
     * @return void
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    
    /**
     * setAttributes 
     * 
     * @param mixed $attributes 
     * @access public
     * @return void
     */
    public function setAttributes(AttributeMap $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

	public function get($key)
	{
		switch($key) {
		case 'id':
			$value = $this->getId();
			break;
		default:
			$value = $this->getAttributes()->get($key);
			break;
		}

		return $value;
	}
	
	public function set($key, $value)
	{
		switch($key) {
		case 'id':
			$this->setId($value);
			break;
		default:
			$this->getAttributes()->set($key, $value);
			break;
		}

		return $this;
	}
}

