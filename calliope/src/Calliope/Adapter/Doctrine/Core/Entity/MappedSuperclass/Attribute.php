<?php
namespace Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Calliope\Framework\Core\Model\Attribute as BaseAttribute;

/**
 * Attribute 
 * 
 * @uses BaseAttribute
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass
 */
abstract class Attribute extends BaseAttribute
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
	 * key 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 * @ORM\Column(name="`key`", type="string")
	 */
	protected $key;

	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="`value`", type="string", nullable=true)
	 */
	protected $value;
}

