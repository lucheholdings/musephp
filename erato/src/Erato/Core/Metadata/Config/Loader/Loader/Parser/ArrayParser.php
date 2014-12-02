<?php
namespace Clio\Extra\Metadata\Config\Parser;

use Clio\Component\Pattern\Loader\Parser;

class ArrayParser implements Parser 
{
	/**
	 * parse 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function parse($data)
	{
		if(!$this->canParse($data)) {
			throw new \InvalidArgumentException('Data is not parsable.');
		}

		return $data;
	}

	/**
	 * canParse 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function canParse($data)
	{
		return is_array($data);
	}
}

