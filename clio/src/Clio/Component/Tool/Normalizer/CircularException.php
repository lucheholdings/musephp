<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Exception\CircularException as BaseException;
use Clio\Component\Util\Type\Type;

/**
 * CircularException 
 * 
 * @uses Exception
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CircularException extends BaseException 
{
	private $data;

	private $type;

	public function __construct($data, Type $type, $message = '', $code = 0, \Exception $prev = null)
	{
		parent::__construct($message, $code, $prev);

		$this->data = $data;
		$this->type = $type;
	}
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function setType(Type $type)
    {
        $this->type = $type;
        return $this;
    }
}

