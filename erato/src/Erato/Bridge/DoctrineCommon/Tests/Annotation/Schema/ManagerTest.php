<?php
namespace Erato\Bridge\DoctrineCommon\Tests\Annotation\Schema;

use Erato\Bridge\DoctrineCommon\Tests\Annotation\AnnotationTestCase;

class ManagerTest extends AnnotationTestCase 
{
    public function testAnnotation()
    {
		$reflector = $this->getTestClassReflector();
		$reader = $this->getReader(); 

		$annot = $reader->getClassAnnotation($reflector, 'Erato\Bridge\DoctrineCommon\Annotation\Schema\Manager');
		
		$this->assertEquals('Custom\ManagerClass', $annot->value);
		$this->assertEquals('class_factory.service', $annot->factory);
    }
}

