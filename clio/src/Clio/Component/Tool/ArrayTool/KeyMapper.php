<?php
namespace Clio\Component\Tool\ArrayTool;

use Clio\Component\Util\Container\Map\Map as BaseMap;
/**
 * KeyMapper 
 *    Map array keys from Key to Value
 * 
 * @uses AbstractMap
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class KeyMapper extends BaseMap implements Mapper
{
	/**
	 * {@inheritdoc}
	 */
	public function map(array $values)
	{
		return $this->doMap($values, $this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function inverseMap(array $values)
	{
		return $this->doMap($values, array_flip($this->toArray()));
	}

	/**
	 * doMap 
	 * 
	 * @param array $values 
	 * @param array $maps 
	 * @access protected
	 * @return void
	 */
	protected function doMap(array $values, array $maps)
	{
		$mappedValues = array();
		foreach($values as $key => $value) {
			if(isset($maps[$key])) {
				$mappedValues[$maps[$key]] = $value;
			} else {
				$mappedValues[$key] = $value;
			}
		}
		return $mappedValues;
	}
}

