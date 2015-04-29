<?php
namespace Calliope\Core\Schema\Manager\Factory;

use Clio\Extra\Pattern\Factory\ValidationFactory;
use Calliope\Core\Connection;
use Clio\Component\Pattern\Factory;
use Clio\Component\Validator;

/**
 * ClassFactory 
 * 
 * @uses BaseFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassFactory extends ValidationFactory 
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
	public function __construct()
	{
        parent::__construct(new Factory\ClassFactory());

		$this->setValidator(new Validator\SubclassValidator('Calliope\Core\Manager'));
	}

    /**
     * createManager 
     * 
     * @param mixed $managerClass 
     * @param Metadata\Schema $schemaMetadata 
     * @param Connection $connection 
     * @access public
     * @return void
     */
	public function createManager($managerClass, Metadata\Schema $schema, Connection $connection, array $options = array())
	{
		return $this->create($managerClass, $schema, $connection, $options);
	}
}

