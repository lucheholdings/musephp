<?php
namespace Calliope\Bridge\DoctrineOrm\Connection;

use Calliope\Bridge\DoctrineCommon\Connection\ConnectionFactory as BaseConnectionFactory;
use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository
;
/**
 * DoctrineOrmConenctionFactory 
 * 
 * @uses ConnectionFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConnectionFactory extends BaseConnectionFactory 
{

	const CONNECTION_CLASS = 'Calliope\Bridge\DoctrineOrm\Connection\Connection';

	/**
	 * doCreateConnection 
	 * 
	 * @param ObjectManager $manager 
	 * @param ObjectRepository $repository 
	 * @access protected
	 * @return void
	 */
	protected function doCreateConnection(ObjectManager $manager)
	{
		return new Connection($manager);
	}
}

