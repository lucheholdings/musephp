<?php
namespace Clio\Adapter\DoctrineExtensions\Behavior\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Clio\Extra\Model\Tag as BaseTag;

/**
 * Tag 
 * 
 * @uses BaseTag
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass
 */
abstract class Tag extends BaseTag
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 */
	protected $owner;

	/**
	 * name
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 * @ORM\Column(name="`name`", type="string")
	 */
	protected $name;
}

