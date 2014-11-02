<?php
namespace Calliope\Framework\Core\Tests;

use Calliope\Framework\Core\Model\TaggableFlexibleModel;
use Calliope\Framework\Core\Container\AttributeMap;
use Clio\Component\Tag\Collection\TagSet;
use Calliope\Framework\Core\Model\Attribute,
	Clio\Component\Tag\Tag;

/**
 * TestFlexibleSchemaModel 
 * 
 * @uses TaggableFlexibleModelModel
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TestFlexibleSchemaModel extends TaggableFlexibleModel 
{
	/**
	 * label 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $label;

	public function __construct()
	{
		parent::__construct();

		$this->getAttributes()
			->addAttribute(new Attribute('foo', 'Foo'))
			->addAttribute(new Attribute('bar', 'Bar'))
		;
	}

	public function toSerializedArray()
	{
		return array(
			'hash' => $this->getHash(),
			'label' => $this->getLabel(),
			'foo' => $this->getAttributes()->getElementValue('foo'),
			'bar' => $this->getAttributes()->getElementValue('bar'),
			'tags' => $this->getTags()->toNameArray(),
			'created_at' => $this->getCreatedAt()->format('Y-m-d\TH:i:sO'),
			'updated_at' => $this->getCreatedAt()->format('Y-m-d\TH:i:sO'),
		);
	}
    
    /**
     * Get label.
     *
     * @access public
     * @return label
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Set label.
     *
     * @access public
     * @param label the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
}

