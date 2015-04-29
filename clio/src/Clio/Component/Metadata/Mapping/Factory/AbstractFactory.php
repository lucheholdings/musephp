<?php
namespace Clio\Component\Metadata\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory;
use Clio\Component\Pattern\Factory\AbstractFactory as BaseFactory;
use Clio\Component\Metadata\Metadata;

/**
 * AbstractFactory 
 * 
 * @uses AbstractFactory
 * @uses Factory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFactory extends BaseFactory implements Factory 
{
	/**
	 * options 
	 * 
	 * @var array
	 * @access private
	 */
	private $options = array();

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args = array())
	{
		$metadata = array_shift($args);
		return $this->createMapping($metadata);
	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @final
	 * @access public
	 * @return void
	 */
	public final function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = $this->doCreateMapping($metadata, $options);

		// Inject Dependencies
		$injector = $this->getInjector();
		if($injector) {
			$injector->inject($mapping, false);
		}
		return $mapping;
	}

	/**
	 * doCreateMapping 
	 * 
	 * @param Metadata $metadata 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doCreateMapping(Metadata $metadata, array $options);

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		$metadata = array_shift($args);
		return ($metadata instanceof Metadata) && $this->isSupportedMetadata($metadata);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return true;
	}

	public function getInjector()
	{
		return null;
	}
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param mixed $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	/**
	 * hasOption 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasOption($name)
	{
		return isset($this->options[$name]);
	}

	/**
	 * getOption 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getOption($name, $default = null)
	{
		return isset($this->options[$name]) ? $this->options[$name] : $default;
	}

	/**
	 * setOption 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
	}
}

