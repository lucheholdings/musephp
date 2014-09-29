<?php
namespace Calliope\Framework\Core\Container\Validator;

/**
 * TagValidator 
 * 
 * @uses ClassValidator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagSetValidator extends ClassValidator
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct('Clio\Component\Util\Tag\Tag');
	}

	/**
	 * validate 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function validate($value)
	{
		return $value->getName();
	}
}

