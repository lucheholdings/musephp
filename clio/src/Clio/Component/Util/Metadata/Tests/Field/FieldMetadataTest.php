<?php
namespace Clio\Component\Util\Metadata\Tests\Field;

use Clio\Component\Util\Metadata\Field\FieldMetadata;
use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Type as Types;

/**
 * FieldMetadataTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldMetadataTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testConstruct 
     * 
     * @access public
     * @return void
     */
    public function testConstruct()
    {
        $owner = new SchemaMetadata(new Types\Actual\ArrayType());
        $metadata = new FieldMetadata($owner, 'foo', new SchemaMetadata(new Types\Actual\MixedType()));

        $this->assertEquals('foo', $metadata->getName());
        $this->assertEquals('foo', (string)$metadata);
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\MixedType', $metadata->getTypeSchema()->getType());
    }
}

