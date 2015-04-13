<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Util\Type as Types;

/**
 * DateTimeStrategy
 * 
 * @uses AbstractNormalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DateTimeStrategy extends ObjectStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	const DEFAULT_FORMAT = 'Y-m-d H:i:s';

	private $format;

	public function __construct($format = self::DEFAULT_FORMAT)
	{
		$this->format = $format;
	}

	protected function doNormalize($data, Type $type, Context $context)
	{
		if($type->options->has('format')) {
			$format = $type->options->get('format');
		} else {
			$format = $this->getFormat();
		}

		return $data->format($format);
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if($type->options->has('format')) {
			$format = $type->options->get('format');
		} else {
			$format = $this->getFormat();
		}

		return DateTime::createFromFormat($format, $data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type->isType(Types\PrimitiveTypes::TYPE_CLASS) && ('DateTime' == $type->getName()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type->isType(Types\PrimitiveTypes::TYPE_CLASS) && ('DateTime' == $type->getName()));
	}

    
    public function getFormat()
    {
        return $this->format;
    }
    
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }
}
