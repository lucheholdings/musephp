<?php
namespace Clio\Component\Tool\Serializer\Tool;

use Clio\Component\Tool\Serializer\Exception;

use Clio\Component\IO\Format\Parser,
	Clio\Component\IO\Format\Dumper;

/**
 * ArrayFormatter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayParser 
{
	/**
	 * dumpers 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $dumpers;

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
	 * @param array $formats 
	 * @access public
	 * @return void
	 */
	public function __construct(array $formats = array())
	{
		foreach($formats as $format => $parser) {
			$this->addFormat($format, $parser);
		}
	}

	/**
	 * addFormat 
	 * 
	 * @param mixed $format 
	 * @param mixed $parser 
	 * @access public
	 * @return void
	 */
	public function addFormat($format, $parser)
	{
		if(is_array($parser)) {
			foreach($parser as $p) {
				$this->addFormat($format, $p);
			}
		} else {
			if($parser instanceof Parser) {
				$this->parsers[$format] = $parser;
			}

			if($parser instanceof Dumper) {
				$this->dumpers[$format] = $parser;
			}
		}
	}

	/**
	 * parse 
	 * 
	 * @param array $data 
	 * @param mixed $format 
	 * @access public
	 * @return void
	 */
	public function parse($data, $format = null) 
	{
		if('array' == $format) {
			return $data;
		}

		return $this->getParser($format)->parse($data);
	}

	public function dump(array $data, $format = null) 
	{
		if('array' == $format) {
			return $data;
		}

		return $this->getDumper($format)->dump($data);
	}

	public function hasParser($format) 
	{
		return isset($this->parsers[$format]);
	}

	public function hasDumper($format) 
	{
		return isset($this->dumpers[$format]);
	}

	public function getParser($format) 
	{
		if(!isset($this->parsers[$format])) {
			throw new Exception\UnsupportedFormatException(sprintf('Format "%s" is not supported to parse.', $format));
		}

		return $this->parsers[$format];
	}

	public function getDumper($format) 
	{
		if(!isset($this->dumpers[$format])) {
			throw new Exception\UnsupportedFormatException(sprintf('Format "%s" is not supproted to dump', $format));
		}

		return $this->dumpers[$format];
	}
    
    /**
     * Get dumpers.
     *
     * @access public
     * @return dumpers
     */
    public function getDumpers()
    {
        return $this->dumpers;
    }
    
    /**
     * Set dumpers.
     *
     * @access public
     * @param dumpers the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDumpers($dumpers)
    {
        $this->dumpers = $dumpers;
        return $this;
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

