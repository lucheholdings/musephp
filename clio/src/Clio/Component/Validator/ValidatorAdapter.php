<?php
namespace Clio\Component\Validator;

/**
 * AdapterValidator 
 * 
 * @uses Validator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AdapterValidator implements Validator
{
	/**
	 * __construct 
	 * 
	 * @param Validator $validator 
	 * @access public
	 * @return void
	 */
	public function __construct(Validator $validator)
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
		return $this->validator->validate($data);
	}
}

