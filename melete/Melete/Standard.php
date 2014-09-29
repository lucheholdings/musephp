<?php
namespace Melete;

/**
 * Standard 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class Standard implements Definition, \IteratorAggregate, \Countable
{
	private $name;

	protected $contents;

	public function __construct($name)
	{
		$this->name = $name;
	}
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	public function getClass()
	{
		return new \ReflectionClass(get_class($this));
	}
    
    public function getContents()
    {
        return $this->contents;
    }
    
    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }

	public function filter(\Closure $p)
	{
        return array_filter($this->contents, $p);
	}

	public function map(Closure $p)
	{
		return array_map($p, $this->contents);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->contents);
	}

	public function count()
	{
		return count($this->contents);
	}
}

