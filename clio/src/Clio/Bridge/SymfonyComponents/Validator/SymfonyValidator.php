<?php
namespace Clio\Bridge\SymfonyComponents\Validator;

use Clio\Component\Util\Validator\Validator;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * SymfonyValidator 
 * 
 * @uses Validator
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SymfonyValidator implements Validator
{
	/**
	 * validator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $validator;

	/**
	 * __construct 
	 * 
	 * @param ValidatorInterface $validator 
	 * @access public
	 * @return void
	 */
	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate($data)
	{
		$groups = null;
		$traverse = false;
		$deep = false;
		return $this->validator->validate($data, $groups, $traverse, $deep);
	}
    
    /**
     * getValidator 
     * 
     * @access public
     * @return void
     */
    public function getValidator()
    {
        return $this->validator;
    }
    
    /**
     * setValidator 
     * 
     * @param mixed $validator 
     * @access public
     * @return void
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;
        return $this;
    }
}

