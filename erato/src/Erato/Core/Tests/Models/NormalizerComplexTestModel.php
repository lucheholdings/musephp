<?php
namespace Erato\Core\Tests\Models;

class NormalizerComplexTestModel 
{
	private $id;

	private $self;

	private $child;

	public function __construct($id, $foo, $bar, $hoge)
	{
		$this->id = $id;
		$this->child = new NormalizerTestModel($foo, $bar, $hoge);

		$this->self = $this;
	}
    
    public function getChild()
    {
        return $this->child;
    }
    
    public function setChild($child)
    {
        $this->child = $child;
        return $this;
    }
    
    public function getSelf()
    {
        return $this->self;
    }
    
    public function setSelf($self)
    {
        $this->self = $self;
        return $this;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}

