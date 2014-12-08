<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\Event;

use Calliope\Core\Filter\Request,
	Calliope\Core\Filter\Response
;

use Symfony\Component\EventDispatcher\Event;

/**
 * FilterEvent 
 * 
 * @uses Event
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FilterEvent extends Event 
{
	private $request;

	private $response;

	public function __construct(Request $request, Response $response = null)
	{
		$this->request = $request;
		$this->response = $response;
	}
    
    public function getRequest()
    {
        return $this->request;
    }
    
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }
    
    public function getResponse()
    {
        return $this->response;
    }
    
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }
}

