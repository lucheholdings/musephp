<?php
namespace Calliope\Framework\Core\Tests\Property;

use Calliope\Framework\Core\Tests\TestFlexibleSchemeModel,
	Calliope\Framework\Core\Metadata\ClassMetadata,
	Calliope\Framework\Core\Property\ObjectPropertyCollection
;

/**
 * Class 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ObjectPropertyCollectionTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * metadata 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $metadata;

	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $classMetadata;

	public function setUp()
	{
		$this->metadata = new TestFlexibleSchemeModel(); 
		$this->classMetadata = new ClassMetadata(new \ReflectionClass($this->metadata));
	}

	public function testGetNames()
	{
		$properties = new ObjectPropertyCollection($this->getClassMetadata(), $this->getMetadata());

		$names = $properties->getNames();

		// tags
		// attributes.foo
		// attributes.bar
		// hash
		// createdAt
		// updatedAt
		$this->assertCount(8, $names);
		$this->assertContains('tags', $names);
		$this->assertContains('label', $names);
		$this->assertContains('foo', $names);
		$this->assertContains('bar', $names);
		$this->assertContains('hash', $names);
		$this->assertContains('createdAt', $names);
		$this->assertContains('updatedAt', $names);
	}
    
    /**
     * Get metadata.
     *
     * @access public
     * @return metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
    
    /**
     * Get classMetadata.
     *
     * @access public
     * @return classMetadata
     */
    public function getClassMetadata()
    {
        return $this->classMetadata;
    }
}

