<?php
namespace Clio\Component\Metadata\Tests\Field;

use Clio\Component\Metadata\Field\FieldMetadata;
use Clio\Component\Metadata\Schema\SchemaMetadata;
use Clio\Component\Type as Types;

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
        $metadata = new FieldMetadata($owner, 'foo', new SchemaMetadata(new Types\MixedType()));

        $this->assertEquals('foo', $metadata->getName());
        $this->assertEquals('foo', (string)$metadata);
        $this->assertInstanceof('Clio\Component\Type\MixedType', $metadata->getTypeSchema()->getType());
    }
}

