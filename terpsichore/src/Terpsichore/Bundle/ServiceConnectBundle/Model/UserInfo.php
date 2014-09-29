<?php
namespace Terpsichore\Bundle\ServiceConnectBundle\Model;

class UserInfo 
{
	private $id;

	private $username;

	private $realname;

	private $email;

	private $profilePicture;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    
    public function getRealname()
    {
        return $this->realname;
    }
    
    public function setRealname($realname)
    {
        $this->realname = $realname;
        return $this;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }
    
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
        return $this;
    }
}

