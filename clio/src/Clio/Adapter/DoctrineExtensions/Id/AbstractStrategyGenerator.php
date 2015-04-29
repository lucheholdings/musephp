<?php
namespace Clio\Adapter\DoctrineExtensions\Id;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

use Clio\Component\Id\Generator\Strategy;

/**
 * AbstractStrategyGenerator 
 * 
 * @uses AbstractIdGenerator
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractStrategyGenerator extends AbstractIdGenerator 
{
	/**
	 * generate 
	 * 
	 * @param EntityManager $em 
	 * @param mixed $entity 
	 * @access public
	 * @return void
	 */
	public function generate(EntityManager $em, $entity)
	{
        return $this->getStrategy()->generate();
	}

    /**
     * getStrategy 
     * 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function getStrategy();
}

