<?php
namespace Calliope\Framework\Core\Metadata\Mapping;

use Clio\Component\Pce\Construction\ComponentFactory;
use Clio\Component\Pce\Metadata\AbstractClassMapping;

use Calliope\Framework\Core\Tool\Merger,
	Calliope\Framework\Core\Tool\Replacer
;
use Calliope\Framework\Core\Builder\SchemeModelBuilderFactory;

/**
 * SchemeMapping 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeMapping extends AbstractClassMapping
{
	private $componentFactory;

	private $builderFactory;

	/**
	 * merger 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $merger;

	/**
	 * replacer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $replacer;

	/**
	 * setBuilderFactory 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setBuilderClass($builderClass)
	{
		$this->builderFactory = new ComponentFactory($builderClass);
		return $this;
	}

	/**
	 * createBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	public function createBuilder()
	{
		return $this->getBuilderFactory()->create($this->getClassMetadata());
	}

	/**
	 * getComponentFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getComponentFactory()
	{
		if(!$this->componentFactory) {
			$this->componentFactory = new ComponentFactory($this->getClassMetadata()->getReflectionClass());
		}

		return $this->componentFactory;
	}
    
    /**
     * Get merger.
     *
     * @access public
     * @return merger
     */
    public function getMerger()
    {
		if(!$this->merger) {
			$this->merger = new Merger($this->getClassMetadata());

			$this->merger->addIgnoreField('createdAt');
			$this->merger->addIgnoreField('updatedAt');
		}
        return $this->merger;
    }
    
    /**
     * Set merger.
     *
     * @access public
     * @param merger the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setMerger(Merger $merger)
    {
        $this->merger = $merger;
        return $this;
    }
    
    /**
     * Get replacer.
     *
     * @access public
     * @return replacer
     */
    public function getReplacer()
    {
		if(!$this->replacer) {
			$this->replacer = new Replacer($this->getClassMetadata());
		}
        return $this->replacer;
    }
    
    /**
     * Set replacer.
     *
     * @access public
     * @param replacer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setReplacer(Replacer $replacer)
    {
        $this->replacer = $replacer;
        return $this;
    }
    
    /**
     * Get builderFactory.
     *
     * @access public
     * @return builderFactory
     */
    public function getBuilderFactory()
    {
		if(!$this->builderFactory) {
			// Set default builder
			$this->builderFactory = new SchemeModelBuilderFactory();
		}
        return $this->builderFactory;
    }
    
    /**
     * Set builderFactory.
     *
     * @access public
     * @param builderFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setBuilderFactory($builderFactory)
    {
        $this->builderFactory = $builderFactory;
        return $this;
    }
}

