<?php
namespace Erato\Core\Tests\Models;

class SimpleModel  
{
    private $privateProperty;

    protected $protectedProperty;

    public $publicProperty;
    
    public function getPrivateProperty()
    {
        return $this->privateProperty;
    }
    
    public function setPrivateProperty($privateProperty)
    {
        $this->privateProperty = $privateProperty;
        return $this;
    }
    
    public function getProtectedProperty()
    {
        return $this->protectedProperty;
    }
    
    public function setProtectedProperty($protectedProperty)
    {
        $this->protectedProperty = $protectedProperty;
        return $this;
    }
    
    public function getPublicProperty()
    {
        return $this->publicProperty;
    }
    
    public function setPublicProperty($publicProperty)
    {
        $this->publicProperty = $publicProperty;
        return $this;
    }
}

