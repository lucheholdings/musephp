<?php
namespace Clio\Component\Container\Tests\ArrayImpl;

use Clio\Component\Container\Tests\SetTestCase;
use Clio\Component\Container\ArrayImpl\Set;

class SetTest extends SetTestCase 
{
    protected function createContainer($defaults = null)
    {
        return new Set($defaults);
    }
}


