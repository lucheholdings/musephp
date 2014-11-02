<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Schema;
/**
 * ArraySchema 
 * 
 * @uses Schema
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArraySchema implements Schema
{
	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * __construct 
	 * 
	 * @param array $data 
	 * @access public
	 * @return void
	 */
	public function __construct(array $data)
	{
		foreach($data as $key => $value) {
			$this->fields[] = new Field($this, $key);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * addField 
	 * 
	 * @param Field $field 
	 * @access public
	 * @return void
	 */
	public function addField(Field $field)
	{
		$this->fields[] = $field;
	}
}

