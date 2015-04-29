<?php
namespace Clio\Component\Schemifier\Tests;

use Clio\Component\Serializer\Object;

class TestModel2 implements 
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
	 * hoge
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $hoge;
    
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
     * Get hoge.
     *
     * @access public
     * @return hoge
     */
    public function getHoge()
    {
        return $this->hoge;
    }
    
    /**
     * Set hoge.
     *
     * @access public
     * @param hoge the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setHoge($hoge)
    {
        $this->hoge = $hoge;
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
			'hoge' => $this->hoge
		);
	}

	public function deserializeArray(array $data)
	{
		$this->foo = $data['foo'];
		$this->hoge = $data['hoge'];
	}
}
