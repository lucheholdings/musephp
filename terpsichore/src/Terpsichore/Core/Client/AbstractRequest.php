<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Client;

use Terpsichore\Core\Auth\Token;

abstract class AbstractRequest implements Request
{
	/**
	 * prepared 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $prepared;

	private $contents;

	private $securityToken;

	public function __construct()
	{
		$this->prepared = false;
	}
    
    public function getSecurityToken()
    {
        return $this->securityToken;
    }
    
    public function setSecurityToken(Token $securityToken)
    {
        $this->securityToken = $securityToken;
        return $this;
    }
    
    public function getContents()
    {
        return $this->contents;
    }
    
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }

	public function isPrepared()
	{
		return $this->prepared;
	}

	public function dirty()
	{
		$this->prepared = false;
	}

	protected function prepare()
	{
		$this->prepared = true;
	}
}

