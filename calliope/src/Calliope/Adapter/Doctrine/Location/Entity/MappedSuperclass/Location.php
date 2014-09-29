<?php
namespace Calliope\Geo\Location\Doctrine\Entity\MappedSuperclass;

use Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass\TaggableFlexibleModel;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass()
 */
abstract class Location extends TaggableFlexibleModel
{
	/**
	 * id 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Id
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * name
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="name", type="string")
	 */
	protected $name;
    
    /**
     * Get id.
     *
     * @access public
     * @return id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
