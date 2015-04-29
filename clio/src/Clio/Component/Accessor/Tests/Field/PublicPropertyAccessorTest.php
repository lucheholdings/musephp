<?php
namespace Clio\Component\Accessor\Tests\Field;

use Clio\Component\Accessor\Tests\Models;
use Clio\Component\Accessor\Tests\SingleFieldAccessorTestCase;
use Clio\Component\Accessor\Field\PublicPropertyAccessor;

/**
 * PublicPropertyAccessorTest 
 * 
 * @uses Clio\Component\Accessor\Tests\SingleFieldAccessorTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PublicPropertyAccessorTest extends SingleFieldAccessorTestCase
{

    protected function createAccessor()
    {
        $reflector = new \ReflectionProperty('Clio\Component\Accessor\Tests\Models\TestModel', 'publicProperty');
        return new PublicPropertyAccessor('public_property', $reflector);
    }

    protected function createData()
    {
        return new Models\TestModel();
    }

    protected function getFieldName()
    {
        return 'public_property';
    }

    protected function getFieldValue($data)
    {
        return $data->publicProperty;
    }
}

