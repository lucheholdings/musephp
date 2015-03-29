<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

use Clio\Component\Util\Grammer\Grammer;
/**
 * KeyCaseMapper 
 *    Convert array keys to specified case.
 * 
 * @uses AbstractMap
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class KeyCaseMapper extends AbstractMapper implements Mapper
{
    const CAMEL_CASE  = 'camel';
    const SNAKE_CASE  = 'snake';
    const PASCAL_CASE = 'pascal';

    /**
     * srcCase 
     * 
     * @var mixed
     * @access private
     */
    private $srcCase;

    /**
     * dstCase 
     * 
     * @var mixed
     * @access private
     */
    private $dstCase;

    /**
     * __construct 
     * 
     * @param mixed $dstCase 
     * @param mixed $srcCase 
     * @param mixed $isStrict 
     * @access public
     * @return void
     */
    public function __construct($dstCase, $srcCase = null, $isStrict = true)
    {
        $this->dstCase = $dstCase;
        $this->srcCase = $srcCase;

        parent::__construct($isStrict);
    }

	/**
	 * {@inheritdoc}
	 */
	public function map(array $values)
	{
		return $this->doMap($values, $this->srcCase, $this->dstCase);
	}

	/**
	 * {@inheritdoc}
	 */
	public function inverseMap(array $values)
	{
        if($this->srcCase) {
            return $this->doMap($values, $this->dstCase, $this->srcCase);
        } else if($this->isStrict()) {
            throw new \RuntimeException('KeyCaseMapper cannot inversely map the value without Source Case.');
        }
        return $values;
    }

    /**
     * doMap 
     * 
     * @param array $values 
     * @param mixed $srcCase 
     * @param mixed $dstCase 
     * @access protected
     * @return void
     */
    protected function doMap(array $values, $srcCase, $dstCase)
    {
        if($srcCase == $dstCase) {
            // filter the value if the case of key is mismatched.
            if($this->isStrict()) {
                $mapped = array();
                foreach($values as $key => $value) {
                    if($this->isCase($key, $srcCase)) {
                        $mapped[$key] = $value;   
                    }
                }
                return $mapped;
            }
            return $values;
        } else {
            // need convert
            $mapped = array();
            foreach($values as $key => $value) {
                if(!$this->isStrict() || $this->isCase($key, $srcCase)) {
                    $key = $this->convertCase($key, $dstCase);
                    $mapped[$key] = $value;
                } 
            }
            return $mapped;
        }
	}

    /**
     * isCase 
     * 
     * @param mixed $value 
     * @param mixed $case 
     * @access protected
     * @return void
     */
    protected function isCase($value, $case)
    {
        switch($case) {
        case self::CAMEL_CASE:
            return Grammer::isCamelCase($value);
        case self::PASCAL_CASE:
            return Grammer::isPascalCase($value);
        case self::SNAKE_CASE:
            return Grammer::isSnakeCase($value);
        default:
            throw new \InvalidArgumentException(sprintf('Case "%s" is unrecognized.', $case));
        }
    }

    /**
     * convertCase 
     * 
     * @param mixed $value 
     * @param mixed $case 
     * @access protected
     * @return void
     */
    protected function convertCase($value, $case)
    {
        switch($case) {
        case self::CAMEL_CASE:
            return Grammer::camelize($value);
        case self::PASCAL_CASE:
            return Grammer::pascalize($value);
        case self::SNAKE_CASE:
            return Grammer::snakize($value);
        default:
            throw new \InvalidArgumentException(sprintf('Case "%s" is unrecognized.', $case));
        }
    }
}

