<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Bundle\ServiceBundle;

use Clio\Bridge\SymfonyDI\Registry\ServiceContainerRegistry;

/**
 * Registry 
 * 
 * @uses ServiceContainerRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Registry extends AliasServiceRegistry
{
	/**
	 * {@inheritdoc}
	 */
	protected function isValidService($service)
	{
		return ($service instanceof Service);
	}
}

