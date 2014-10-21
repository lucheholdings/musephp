<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Exception\CircularException as BaseException;

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

	public function __construct($message = '', $data = null, $code = 0, \Exception $prev = null)
	{
		parent::__construct($message, $code, $prev);

		$this->data = $data;
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
}

