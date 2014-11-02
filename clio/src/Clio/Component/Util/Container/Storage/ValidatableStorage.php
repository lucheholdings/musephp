<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;
use Clio\Component\Exception as Exceptions;
use Clio\Component\Util\Validator\Validator;

/**
 * ValidatableStorage 
 * 
 * @uses ProxyStorage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ValidatableStorage extends ProxyStorage 
{
	/**
	 * keyValidator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $keyValidator;

	/**
	 * valueValidator 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $valueValidator;

	// SetAccessable
	/**
	 * {@inheritdoc}
	 */
	public function insert($value)
	{
		if($this->hasValueValidator()) {
			$this->getValueValidator()->validate($value);
		}

		parent::insert($value);
	}

	// SequencialAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function insertBegin($value)
	{
		if($this->hasValueValidator()) {
			$this->getValueValidator()->validate($value);
		}

		parent::insertBegin($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertEnd($value)
	{
		if($this->hasValueValidator()) {
			$this->getValueValidator()->validate($value);
		}

		parent::insertEnd($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertAt($key, $value)
	{
		if($this->hasKeyValidator()) {
			$this->getKeyValidator()->validate($key);
		}

		if($this->hasValueValidator()) {
			$this->getValueValidator()->validate($value);
		}

		parent::insertAt($key, $value);
	}

	/**
	 * hasKeyValidator 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasKeyValidator()
	{
		return (bool)$this->keyValidator;
	}
    
    /**
     * getKeyValidator 
     * 
     * @access public
     * @return void
     */
    public function getKeyValidator()
    {
        return $this->keyValidator;
    }
    
    /**
     * setKeyValidator 
     * 
     * @param Validator $keyValidator 
     * @access public
     * @return void
     */
    public function setKeyValidator(Validator $keyValidator)
    {
		if(!$this->getSource() instanceof RandomAccessable) {
			throw new Exceptions\UnsupportedException('Storage is not a RandomAccessable, which dose not have key to validate.');
		}
        $this->keyValidator = $keyValidator;
        return $this;
    }

	/**
	 * hasValueValidator 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasValueValidator()
	{
		return (bool)$this->valueValidator;
	}
    
    /**
     * getValueValidator 
     * 
     * @access public
     * @return void
     */
    public function getValueValidator()
    {
        return $this->valueValidator;
    }
    
    /**
     * setValueValidator 
     * 
     * @param Validator $valueValidator 
     * @access public
     * @return void
     */
    public function setValueValidator(Validator $valueValidator)
    {
        $this->valueValidator = $valueValidator;
        return $this;
    }
}

