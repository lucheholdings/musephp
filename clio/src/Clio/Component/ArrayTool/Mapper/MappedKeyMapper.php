<?php
namespace Clio\Component\ArrayTool\Mapper;

/**
 * MappedKeyMapper 
 *    Map array keys with KeyMap 
 * 
 * @uses AbstractMap
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappedKeyMapper extends AbstractMapper implements Mapper
{
    /**
     * keys 
     * 
     * @var array
     * @access private
     */
    private $keys = array();

    public function __construct(array $keys = array(), $isStrict = true)
    {
        $this->keys = $keys;
        parent::__construct($isStrict);
    }

	/**
	 * {@inheritdoc}
	 */
	public function map(array $values)
	{
		return $this->doMap($values, $this->keys);
	}

	/**
	 * {@inheritdoc}
	 */
	public function inverseMap(array $values)
	{
		return $this->doMap($values, $this->keys, true);
	}

	/**
	 * doMap 
	 * 
	 * @param array $values 
	 * @param array $keys 
	 * @access protected
	 * @return void
	 */
	protected function doMap(array $values, array $keys, $inverse = false)
	{
		$mappedValues = array();
		
		foreach($keys as $key => $mappedKey) {
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

        // if not strict, then copy remain
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

