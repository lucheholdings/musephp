<?php
namespace Calliope\Adapter\Doctrine\Transport\Entity\MappedSuperclass;

use Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass\TaggableFlexibleModel;
use Calliope\Extension\Transport\Model\LineInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Station 
 * 
 * @uses TaggableFlexibleModel
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass
 */
abstract class Station extends TaggableFlexibleModel
{
}

