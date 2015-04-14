<?php
namespace Clio\Component\Util\Type;

/**
 * ProxyType 
 * 
 * @uses Type
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyType implements Type
{
    /**
     * type 
     * 
     * @var mixed
     * @access protected
     */
	protected $type;

    /**
     * __construct 
     * 
     * @param Type $type 
     * @access public
     * @return void
     */
	public function __construct(Type $type)
	{
		$this->type = $type;
	}

    /**
     * resolve 
     * 
     * @param Resolver $resolver 
     * @param mixed $data 
     * @access public
     * @return void
     */
	public function resolve(Resolver $resolver, $data = null)
	{
        if(!$this->isResolved()) {
		    $this->type = $resolver->resolve($this->type, array('data' => $data));
        }
		return $this;
	}

    /**
     * getType 
     * 
     * @access public
     * @return void
     */
    public function getType()
    {
		if(!$this->type) {
			throw new \RuntimeException('Proxied type is not specified.');
		}
        return $this->type;
    }
    
    /**
     * setType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function setType($type)
    {
		if(!$type instanceof Type) {
			throw new \InvalidArgumentException('Invalid type');
		}
        $this->type = $type;
        return $this;
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
	public function getName()
	{
		return (string)($this->type);
	}

    /**
     * isType 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
	public function isType($type)
	{
		return $this->getType()->isType($type);
	}

    /**
     * isValidData 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
	public function isValidData($data)
	{
		return $this->getType()->isValidData($data);
	}

    /**
     * __toString 
     * 
     * @access public
     * @return void
     */
	public function __toString()
	{
		return $this->getName();
	}

    /**
     * getRawType 
     * 
     * @access public
     * @return void
     */
	public function getRawType()
	{
		return $this->doGetRawType($this->getType());
	}

    /**
     * doGetRawType 
     * 
     * @param mixed $type 
     * @access protected
     * @return void
     */
	protected function doGetRawType($type)
	{
		if($type instanceof ProxyType) {
			return $this->doGetRawType($type->getType());
		}
		return $type;
	}

    /**
     * isResolved 
     * 
     * @access public
     * @return void
     */
	public function isResolved()
	{
		if($this->getType() instanceof ProxyType) {
			return $this->getType()->isResolved();
		} else if($this->getType() instanceof MixedType) {
			return false;
		}
		return true;
	}

    /**
     * __call 
     * 
     * @param mixed $method 
     * @param array $args 
     * @access public
     * @return void
     */
	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getType(), $method), $args);
	}

    /**
     * newData 
     * 
     * @access public
     * @return void
     */
    public function newData(array $args = array())
    {
        return $this->getType()->newData($args);
    }
}
