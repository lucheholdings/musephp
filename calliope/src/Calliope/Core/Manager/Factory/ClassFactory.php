<?php
namespace Calliope\Core\Manager\Factory;

use Clio\Component\Pattern\Factory\ClassFactory as BaseFactory;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Validator\SubclassValidator;
use Calliope\Core\Connection;

/**
 * ClassFactory 
 * 
 * @uses BaseFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassFactory extends BaseFactory 
{
	protected function initFactory()
	{
		$this->setValidator(new SubclassValidator('Calliope\Core\Manager'));
	}

	public function createManager($managerClass, SchemaMetadata $schemaMetadata, Connection $connection)
	{
		$args = func_get_args();

		return $this->createClassArgs($this->shiftArg($args, 'class'), $args);
	}
}

