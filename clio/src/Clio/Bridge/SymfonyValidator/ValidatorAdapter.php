<?php
namespace Clio\Bridge\SymfonyValidator;

use Clio\Component\Util\Validator\Validator as ValidatorInterface;
use Symfony\Component\Validator\ValidatorInterface as SymfonyValidator;

/**
 * ValidatorAdapter 
 * 
 * @uses ValidatorAdapterInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ValidatorAdapter implements ValidatorInterface
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(SymfonyValidator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * validate 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function validate($data)
	{
		$groups = null;
		$traverse = false;
		$deep = false;
		return $this->validator->validate($data, $groups, $traverse, $deep);
	}
}

