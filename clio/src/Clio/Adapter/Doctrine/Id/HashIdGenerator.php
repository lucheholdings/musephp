<?php
namespace Clio\Adapter\Doctrine\Id;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;

use Clio\Adapter\Doctrine\Util\HashIdUtil;

/**
 * HashIdGenerator 
 * 
 * @uses AbstractIdGenerator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashIdGenerator extends AbstractIdGenerator 
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
		$generator = HashIdUtil::getGeneratorFor($entity);

		return $generator->generate();
	}
}

