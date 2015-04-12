<?php
namespace Clio\Component\Util\Accessor\Tests\Models;

class TestModel 
{

    private $privateProperty;

    protected $protectedProperty;

    public $publicProperty;

    private $onlyGetter;

    private $onlySetter;

    private $getterSetter;
    
    public function getGetterSetter()
    {
        return $this->getterSetter;
    }
    
    public function setGetterSetter($getterSetter)
    {
        $this->getterSetter = $getterSetter;
        return $this;
    }
    
    public function getOnlyGetter()
    {
        return $this->onlyGetter;
    }
    
    public function setOnlySetter($onlySetter)
    {
        $this->onlySetter = $onlySetter;
        return $this;
    }
}

