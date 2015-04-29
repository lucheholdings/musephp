<?php
namespace Clio\Component\Format;

use Clio\Component\Format\Parser;
use Clio\Component\Format\UnsupportedFormatException;

/**
 * CompositeParser 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class CompositeParser implements Parser
{
	/**
	 * parsers 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $parsers;

	/**
	 * __construct 
	 * 
	 * @param array $parsers 
	 * @access public
	 * @return void
	 */
	public function __construct(array $parsers = array())
	{
		foreach($parsers as $parser) {
			$this->add($parser);
		}
	}

	/**
	 * add 
	 * 
	 * @param Parser $parser 
	 * @access public
	 * @return void
	 */
	public function add(Parser $parser)
	{
		$this->parsers[] = $parser;
		return $this;
	}

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function parse($content, $format)
	{
		foreach($this->parsers as $parser) {
			if($parser->isSupportedFormat($format)) {
				return $parser->parse($content, $format);
			}
		}
		
		throw new UnsupportedFormatException(sprintf('Format "%s" is not supported format', $format));
	}

	/**
	 * isSupportedFormat 
	 * 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function isSupportedFormat($format)
	{
		foreach($this->parsers as $parser) {
			if($parser->isSupportedFormat($format)) {
				return true;
			}
		}
		
		return false;
	}
    
    /**
     * Get parsers.
     *
     * @access public
     * @return parsers
     */
    public function getParsers()
    {
        return $this->parsers;
    }
    
    /**
     * Set parsers.
     *
     * @access public
     * @param parsers the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setParsers($parsers)
    {
        $this->parsers = $parsers;
        return $this;
    }
}

