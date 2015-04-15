<?php
namespace Clio\Extra\Tests\Models;

class NormalizerTestModel 
{
    public $foo = 'Foo';

    private $bar = 'Bar';
    
    public function getBar()
    {
        return $this->bar;
    }
    
    public function setBar($bar)
    {
        $this->bar = $bar;
        return $this;
    }
}

