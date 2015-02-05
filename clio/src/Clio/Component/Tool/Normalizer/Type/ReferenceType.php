<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Util\Type\ProxyType;

/**
 * ReferenceType 
 * 
 * @uses ProxyType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ReferenceType extends ProxyType 
{
	public function getIdentifierFields()
	{
		return $this->getRawType()->getIdentifierFields();
	}

	public function getIdentifierValues($data)
	{
		return $this->getRawType()->getIdentifierValues($data);
	}
}

