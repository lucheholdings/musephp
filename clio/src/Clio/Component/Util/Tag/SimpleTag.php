<?php
namespace Clio\Component\Util\Tag;

/**
 * SimpleTag 
 * 
 * @uses Tag
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleTag implements Tag 
{
	/**
	 * {@inheritdoc}
	 */
	private $name;

	/**
	 * {@inheritdoc}
	 */
	public function __construct($name)
	{
		$this->name = (string)$name;
	}
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = (string)$name;
        return $this;
    }
}

