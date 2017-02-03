<?php
namespace Clio\Component\IO\Format\Format;

/**
 * Format 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Format implements Parser, Dumper 
{
	/**
	 * parser 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parser;

	/**
	 * dumper 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $dumper;

	/**
	 * __construct 
	 * 
	 * @param Parser $parser 
	 * @param Dumper $dumper 
	 * @access public
	 * @return void
	 */
	public function __construct(Parser $parser, Dumper $dumper)
	{
		$this->parser = $parser;
		$this->dumper = $dumper;
	}

	/**
	 * parse 
	 * 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function parse($content)
	{
		return $this->getParser()->parse($content);
	}

	/**
	 * dump 
	 * 
	 * @param mixed $content 
	 * @access public
	 * @return void
	 */
	public function dump($content)
	{
		return $this->getDumper()->dump($content);
	}
    
    /**
     * Get parser.
     *
     * @access public
     * @return parser
     */
    public function getParser()
    {
        return $this->parser;
    }
    
    /**
     * Set parser.
     *
     * @access public
     * @param parser the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setParser($parser)
    {
        $this->parser = $parser;
        return $this;
    }
    
    /**
     * Get dumper.
     *
     * @access public
     * @return dumper
     */
    public function getDumper()
    {
        return $this->dumper;
    }
    
    /**
     * Set dumper.
     *
     * @access public
     * @param dumper the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDumper($dumper)
    {
        $this->dumper = $dumper;
        return $this;
    }
}

