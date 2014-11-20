<?php
namespace Terpsichore\Client\Request;

use Terpsichore\Client\Request as RequestInterface;
use Terpsichore\Core\Request\Request as BaseRequest;

/**
 * ServiceRequest 
 * 
 * @uses Request
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ServiceRequest extends BaseRequest implements RequestInterface
{

	/**
	 * dirty 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $dirty;

	/**
	 * __construct 
	 * 
	 * @param mixed $body 
	 * @param mixed $header 
	 * @access public
	 * @return void
	 */
	public function __construct($body = null, array $headers = array())
	{
		$this->dirty = true;

		parent::__construct($body, $headers);
	}
    
	public function setHeader($name, $value)
	{
		parent::setHeader($name, $value);

		$this->dirty();

		return $this;
	}
    
    /**
     * setBody 
     * 
     * @param mixed $body 
     * @access public
     * @return void
     */
    public function setBody($body)
    {
		parent::setBody($body);

		$this->dirty();

        return $this;
    }

	/**
	 * isDirty 
	 * 
	 * @access public
	 * @return void
	 */
	public function isDirty()
	{
		return $this->dirty;
	}

	/**
	 * dirty 
	 * 
	 * @access public
	 * @return void
	 */
	public function dirty()
	{
		$this->dirty = true;
	}

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	public function clean()
	{
		$this->dirty = false;
	}
}

