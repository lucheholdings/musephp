<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\DoctrineExtentions\KeyValue\Entity;

use Doctrine\ORM\Mappings as ORM;

/**
 * KeyValueLong 
 * 
 * @uses KeyValue
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 *
 * @ORM\MappedSuperclass()
 */
abstract class KeyValueLong extends KeyValue
{
	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="`value`", type="text")
	 */
	protected $value;
}
