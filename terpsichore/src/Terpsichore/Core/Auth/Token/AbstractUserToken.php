<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace ;

/**
 * Class 
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class 
{
	private $user;
	public function isAuthenticated()
	{
		return $this->authenticated;
	}

	public function setUser(UserInterface $user)
	{
		$this->user = $user;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function isUserCredentials()
	{
		return $this->isAuthenticated() && (null !== $this->user);
	}
}

