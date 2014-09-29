<?php
namespace Clio\Adapter\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HashedModel 
 *   This is an exmaple of using Hash for Entity ID 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass
 * 
 */
abstract class HashedModel 
{
	/**
	 * hash 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 * @ORM\Column(name="hash", type="string")
	 * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Clio\Adapter\Doctrine\Id\HashIdGenerator") 
	 */
	protected $hash;
    
    /**
     * Get hash.
     *
     * @access public
     * @return hash
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    /**
     * Set hash.
     *
     * @access public
     * @param hash the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
}

