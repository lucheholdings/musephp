<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

/**
 * ScalarType 
 * 
 * @uses NamedType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarType extends NamedType 
{
	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		throw new \RuntimeException('Scalar cannot have a subfield.');
	}
}

