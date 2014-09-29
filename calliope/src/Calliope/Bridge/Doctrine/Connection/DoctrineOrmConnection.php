<?php
namespace Calliope\Bridge\Doctrine\Connection;

use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository;

use Calliope\Framework\Core\Exception as ResourceExceptions;

/**
 * DoctrineOrmConnection 
 * 
 * @uses DoctrineConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmConnection extends DoctrineConnection
{
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		try {
			return parent::findOneBy($criteria, $orderBy);
		} catch(\Doctrine\ORM\NoResultException $ex) {
			throw new ResourceExceptions\NotFoundException($this->getConnectTo()->getClassName(), $criteria, 0, $ex);
		}
	}

	public function delete($model) 
	{
		try {
			return parent::delete($model);
		} catch(\Doctrine\ORM\NoResultException $ex) {
			throw new ResourceExceptions\NotFoundException($this->getConnectTo()->getClassName(), array(), 0, $ex);
		}
	}

	public function update($model) 
	{
		try {
			return parent::update($model);
		} catch(\Doctrine\ORM\NoResultException $ex) {
			throw new ResourceExceptions\NotFoundException($this->getConnectTo()->getClassName(), array(), 0, $ex);
		}
	}
}

