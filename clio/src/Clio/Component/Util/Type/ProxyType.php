<?php
namespace Clio\Component\Util\Type;


class ProxyType implements Type
{
	protected $type;

	public function __construct(Type $type)
	{
		$this->type = $type;
	}

    public function getType()
    {
		if(!$this->type) {
			throw new \RuntimeException('Proxied type is not specified.');
		}
        return $this->type;
    }
    
    public function setType($type)
    {
		if(!$type instanceof Type) {
			throw new \InvalidArgumentException('Invalid type');
		}
        $this->type = $type;
        return $this;
    }

	public function getName()
	{
		return (string)$this->type;
	}

	public function isType($type)
	{
		return $this->getType()->isType($type);
	}

	public function isValidData($data)
	{
		return $this->getType()->isValidData($type);
	}

	public function __toString()
	{
		return $this->getName();
	}

	public function getRawType()
	{
		return $this->doGetRawType($this->getType());
	}

	protected function doGetRawType($type)
	{
		if($type instanceof ProxyType) {
			return $this->doGetRawType($type->getType());
		}
		return $type;
	}

	public function __call($method, array $args = array())
	{
		return call_user_func_array(array($this->getType(), $method), $args);
	}
}
