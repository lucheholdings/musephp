<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Erato\Core\Normalizer;

use Erato\Core\Registry\AliasServiceRegistry;
use Clio\Component\Tool\Normalizer\Normalizer;

/**
 * NormalizerRegistry
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerRegistry extends AliasServiceRegistry 
{
	/**
	 * {@inheritdoc}
	 */
	protected function isValidService($service)
	{
		return ($service instanceof Normalizer);
	}
}

