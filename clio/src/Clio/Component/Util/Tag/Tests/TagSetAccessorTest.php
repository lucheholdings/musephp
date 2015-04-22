<?php
namespace Clio\Component\Util\Tag\Tests;

use Clio\Component\Util\Tag\TagSetAccessor;

class TagSetAccessorTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $accessor = new TagSetAccessor();

        // default tag factory 
        $this->assertInstanceof('Clio\Component\Util\Tag\TagComponentFactory', $accessor->getTagFactory());
    }
}

