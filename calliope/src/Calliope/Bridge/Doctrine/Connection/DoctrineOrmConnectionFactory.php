<?php
namespace Calliope\Bridge\Doctrine\Connection;

use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository
;
/**
 * DoctrineOrmConenctionFactory 
 * 
 * @uses DoctrineConnectionFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmConnectionFactory extends DoctrineConnectionFactory 
{

	const CONNECTION_CLASS = 'Calliope\Bridge\Doctrine\Connection\DoctrineOrmConnection';

	/**
	 * doCreateConnection 
	 * 
	 * @param ObjectManager $manager 
	 * @param ObjectRepository $repository 
	 * @access protected
	 * @return void
	 */
	protected function doCreateConnection(ObjectManager $manager, ObjectRepository $repository)
	{
		return new DoctrineOrmConnection($manager, $repository);
	}
}

