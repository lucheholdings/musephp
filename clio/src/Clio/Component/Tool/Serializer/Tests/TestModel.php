<?php
namespace Clio\Component\Tool\Serializer\Tests;

use Clio\Component\Tool\Serializer\Object;

class TestModel implements 
	Object\ArraySerializable, 
	Object\ArrayDeserializable,
	Object\JsonSerializable, 
	Object\JsonDeserializable
{
	protected $foo;

	protected $bar;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($foo, $bar)
	{
		$this->foo = $foo;
		$this->bar = $bar;
	}
    
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

	public function serializeJson()
	{
		return json_encode($this->serializeArray());
	}

	public function deserializeJson($data)
	{
		return $this->deserializeArray(json_encode($data));
	}

	public function serializeArray()
	{
		return array(
			'foo' => $this->foo,
			'bar' => $this->bar,
		);
	}

	public function deserializeArray(array $data)
	{
		$this->foo = $data['foo'];
		$this->bar = $data['bar'];
	}
}

