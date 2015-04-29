<?php
namespace Clio\Component\Schemifier\Tests;

use Clio\Component\Serializer\Object;

/**
 * TestModel 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TestModel implements 
	Object\ArraySerializable, 
	Object\ArrayDeserializable,
	Object\JsonSerializable, 
	Object\JsonDeserializable 
{
	/**
	 * foo 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $foo;

	/**
	 * bar 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $bar;
    
    /**
     * Get foo.
     *
     * @access public
     * @return foo
     */
    public function getFoo()
    {
        return $this->foo;
    }
    
    /**
     * Set foo.
     *
     * @access public
     * @param foo the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFoo($foo)
    {
        $this->foo = $foo;
        return $this;
    }
    
    /**
     * Get bar.
     *
     * @access public
     * @return bar
     */
    public function getBar()
    {
        return $this->bar;
    }
    
    /**
     * Set bar.
     *
     * @access public
     * @param bar the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setBar($bar)
    {
        $this->bar = $bar;
        return $this;
    }

	/**
	 * serializeJson 
	 * 
	 * @access public
	 * @return void
	 */
	public function serializeJson()
	{
		return json_encode($this->serializeArray());
	}

	/**
	 * deserializeJson 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function deserializeJson($data)
	{
		$this->deserializeArray(json_decode($data, true));
	}

	/**
	 * serializeArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function serializeArray()
	{
		return array(
			'foo' => $this->foo,
			'bar' => $this->bar
		);
	}

	public function deserializeArray(array $data)
	{
		if(isset($data['foo'])) {
			$this->foo = $data['foo'];
		}
		if(isset($data['bar'])) {
			$this->bar = $data['bar'];
		}
	}
}

