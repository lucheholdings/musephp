<?php
namespace Clio\Adapter\DoctrineExtensions\Id;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

/**
 * UUIDGenerator 
 * 
 * @uses AbstractIdGenerator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UUIDGenerator extends AbstractIdGenerator 
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
		// Create UUID
		if(!function_exists('uuid_create')) {
			throw new \RuntimeException('php uuid module is not installed.');
		}

		return uuid_create(UUID_TYPE_RANDOM);
	}
}

