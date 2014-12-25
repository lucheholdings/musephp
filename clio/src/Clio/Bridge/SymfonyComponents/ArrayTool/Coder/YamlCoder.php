<?php
namespace Clio\Bridge\SymfonyComponents\ArrayTool\Coder;

use Symfony\Component\Yaml\Yaml;
use Clio\Component\Tool\ArrayTool\Coder\Encoder,
	Clio\Component\Tool\ArrayTool\Coder\Decoder
;

/**
 * YamlCoder 
 * 
 * @uses AbstractCoder
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class YamlCoder implements Encoder, Decoder
{
	/**
	 * yaml 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $yaml;

	/**
	 * inline 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $inline;

	/**
	 * indent 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $indent;

	/**
	 * __construct 
	 * 
	 * @param Yaml $yaml 
	 * @param int $inline 
	 * @param int $indent 
	 * @access public
	 * @return void
	 */
	public function __construct(Yaml $yaml = null, $inline = 2, $indent = 4)
	{
		if(!$yaml)
			$yaml = new Yaml();

		$this->yaml = $yaml;
		$this->inline = $inline;
		$this->indent = $indent;
	}

	/**
	 * {@inheritdoc}
	 */
	public function encode(array $data)
	{
		return $this->getYaml()->dump($data, $this->getInline(), $this->getIndent());
	}

	/**
	 * {@inheritdoc}
	 */
	public function decode($data)
	{
		return $this->getYaml()->parse($data);
	}
    
    /**
     * getYaml 
     * 
     * @access public
     * @return void
     */
    public function getYaml()
    {
        return $this->yaml;
    }
    
    /**
     * setYaml 
     * 
     * @param mixed $yaml 
     * @access public
     * @return void
     */
    public function setYaml($yaml)
    {
        $this->yaml = $yaml;
        return $this;
    }
    
    /**
     * getInline 
     * 
     * @access public
     * @return void
     */
    public function getInline()
    {
        return $this->inline;
    }
    
    /**
     * setInline 
     * 
     * @param mixed $inline 
     * @access public
     * @return void
     */
    public function setInline($inline)
    {
        $this->inline = $inline;
        return $this;
    }
    
    /**
     * getIndent 
     * 
     * @access public
     * @return void
     */
    public function getIndent()
    {
        return $this->indent;
    }
    
    /**
     * setIndent 
     * 
     * @param mixed $indent 
     * @access public
     * @return void
     */
    public function setIndent($indent)
    {
        $this->indent = $indent;
        return $this;
    }
}

