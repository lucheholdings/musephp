<?php
namespace Clio\Component\Tool\Normalizer\Type;

/**
 * NullType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NullType extends AbstractType  
{
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return self::TYPE_NULL;
	}

	public function isValidData($data)
	{
		return is_null($data);
	}
}

