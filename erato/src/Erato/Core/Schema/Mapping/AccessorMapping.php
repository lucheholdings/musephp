<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Metadata\Mapping\AbstractMapping;
use Clio\Component\Accessor\SchemaAccessor;

/**
 * AccessorMapping 
 *    
 * @uses AbstractMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AccessorMapping extends AbstractMapping 
{
	abstract public function getAccessor();

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'accessor';
	}
}

