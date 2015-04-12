<?php
namespace Clio\Component\Util\Accessor\Tests\Field;

use Clio\Component\Util\Accessor\Tests\Models;
use Clio\Component\Util\Accessor\Tests\SingleFieldAccessorTestCase;
use Clio\Component\Util\Accessor\Field\PublicPropertyAccessor;

/**
 * PublicPropertyAccessorTest 
 * 
 * @uses Clio\Component\Util\Accessor\Tests\SingleFieldAccessorTestCase
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PublicPropertyAccessorTest extends SingleFieldAccessorTestCase
{

    protected function createAccessor()
    {
        $reflector = new \ReflectionProperty('Clio\Component\Util\Accessor\Tests\Models\TestModel', 'publicProperty');
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

