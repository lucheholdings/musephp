<?php
namespace Erato\Bridge\DoctrineCommon\Tests\Annotation;

use Doctrine\Common\Annotations\AnnotationRegistry,
	Doctrine\Common\Annotations\SimpleAnnotationReader
;

class AnnotationTestCase extends \PHPUnit_Framework_TestCase  
{
	private $reader;

	public function setUp()
	{
		$this->initAnnotation();
	}

	public function getTestClassReflector()
	{
		return new \ReflectionClass('Erato\Bridge\DoctrineCommon\Tests\Models\TestClass');
	}

    protected function initAnnotation()
    {
		$this->reader = new SimpleAnnotationReader();

		$this->reader->addNamespace('Erato\Bridge\DoctrineCommon\Annotation');
    }

	protected function getReader()
	{
		return $this->reader;
	}
}

