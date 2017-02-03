<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Pce\Metadata\AbstractClassMapping;

/**
 * NormalizerMapping 
 * 
 * @uses AbstractClassMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerMapping extends AbstractClassMapping 
{
	/**
	 * createInstanceFromNormalizedData 
	 *   Default createInstance is just call the constructor 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function createInstanceFromNormalizedData(array $data = array())
	{
		return $this->getClassMetadata()->newInstance();
	}
}

