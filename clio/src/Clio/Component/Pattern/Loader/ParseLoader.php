<?php
namespace Clio\Component\Pattern\Loader;

class ParseLoader implements Loader 
{
	/**
	 * loader 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $loader;

	/**
	 * parser 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parser;

	/**
	 * __construct 
	 * 
	 * @param Loader $loader 
	 * @param Parser $parser 
	 * @access public
	 * @return void
	 */
	public function __construct(Loader $loader, Parser $parser)
	{
		$this->loader = $loader;
		$this->parser = $parser;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($resource)
	{
		return $this->getLoader()->canLoad($resource);
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($resource)
	{
		$data = $this->getLoader()->load($resource);

		if($data) {
			$parsedData = $this->getParser()->parse($data);
		}

		return $parsedData;
	}
    
    /**
     * getLoader 
     * 
     * @access public
     * @return void
     */
    public function getLoader()
    {
        return $this->loader;
    }
    
    /**
     * setLoader 
     * 
     * @param Loader $loader 
     * @access public
     * @return void
     */
    public function setLoader(Loader $loader)
    {
        $this->loader = $loader;
        return $this;
    }
    
    /**
     * getParser 
     * 
     * @access public
     * @return void
     */
    public function getParser()
    {
        return $this->parser;
    }
    
    /**
     * setParser 
     * 
     * @param Parser $parser 
     * @access public
     * @return void
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
        return $this;
    }
}

