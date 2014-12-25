<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

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
class KeyMapper extends AbstractMapper implements Mapper
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
		return $this->doMap($values, $this->toArray(), true);
	}

	/**
	 * doMap 
	 * 
	 * @param array $values 
	 * @param array $maps 
	 * @access protected
	 * @return void
	 */
	protected function doMap(array $values, array $maps, $inverse = false)
	{
		$mappedValues = array();
		
		foreach($maps as $key => $mappedKey) {
			if(!$inverse) {
				if(isset($values[$key])) {
					$mappedValues[$mappedKey] = $values[$key];
					unset($values[$key]);
				}
			} else {
				if(isset($values[$mappedKey])) {
					$mappedValues[$key] = $values[$mappedKey];

					unset($values[$mappedKey]);
				}
			}
		}

		if(!$this->isStrict()) {
			// copy remain
			foreach($values as $key => $value) {
				if(!isset($mappedValues[$key])) {
					$mappedValues[$key] = $value;
				}
			}
		}
		return $mappedValues;
	}
}

