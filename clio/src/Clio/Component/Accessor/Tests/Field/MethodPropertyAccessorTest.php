<?php
namespace Clio\Component\Accessor\Tests\Field;

use Clio\Component\Accessor\Tests\Models;
use Clio\Component\Accessor\Tests\SingleFieldAccessorTestCase;
use Clio\Component\Accessor\Field\MethodPropertyAccessor;

/**
 * MethodPropertyAccessorTest 
 * 
 * @uses Clio\Component\Accessor\Tests\SingleFieldAccessorTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MethodPropertyAccessorTest extends SingleFieldAccessorTestCase
{

    protected function createAccessor()
    {
        $getter = new \ReflectionMethod('Clio\Component\Accessor\Tests\Models\TestModel', 'getGetterSetter');
        $setter = new \ReflectionMethod('Clio\Component\Accessor\Tests\Models\TestModel', 'setGetterSetter');
        return new MethodPropertyAccessor('getter_setter', $getter, $setter);
    }

    protected function createData()
    {
        return new Models\TestModel();
    }

    protected function getFieldName()
    {
        return 'getter_setter';
    }

    protected function getFieldValue($data)
    {
        return $data->getGetterSetter();
    }
}
