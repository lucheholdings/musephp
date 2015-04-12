<?php
namespace Clio\Component\Util\Accessor\Tests\Field;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\Tests\SingleFieldAccessorTestCase;
use Clio\Component\Util\Accessor\Field\MethodPropertyAccessor;

/**
 * MethodPropertyAccessorTest 
 * 
 * @uses Clio\Component\Util\Accessor\Tests\SingleFieldAccessorTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MethodPropertyAccessorTest extends SingleFieldAccessorTestCase
{

    protected function createAccessor()
    {
        $getter = new \ReflectionMethod('Clio\Component\Util\Accessor\Tests\Models\TestModel', 'getGetterSetter');
        $setter = new \ReflectionMethod('Clio\Component\Util\Accessor\Tests\Models\TestModel', 'setGetterSetter');
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
