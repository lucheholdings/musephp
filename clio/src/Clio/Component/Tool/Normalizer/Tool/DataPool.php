<?php
namespace Clio\Component\Tool\Normalizer\Tool;

use Clio\Component\Util\Type\Type;
use Clio\Component\Util\Type\ProxyType;

/**
 * DataPool 
 *   DataPool is a Mapped Collection which type as key, and data as values 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DataPool 
{
	private $data;

	public function __construct()
	{
		$this->data = array();
	}

	public function add(Type $type, $data)
	{
		$typeName = (string)$type;
		if(!isset($this->data[$typeName])) {
			$this->data[$typeName] = array();
		}

		if($type instanceof ProxyType) {
			$type = $type->getRawType();
		}
		$this->data[$typeName][$this->formatId($type->getIdentifierValues($data))] = $data;
	}

	public function get(Type $type, array $ids)
	{
		$typeName = $type->getName();
		$id = $this->formatId($ids);

		return isset($this->data[$typeName]) && isset($this->data[$typeName][$id]) 
			? $this->data[$typeName][$id]
			: null
		;
	}

	protected function formatId(array $ids)
	{
		ksort($ids);

		return implode('-', $ids);
	}
}

