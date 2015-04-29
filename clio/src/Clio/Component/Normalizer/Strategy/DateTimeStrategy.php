<?php
namespace Clio\Component\Normalizer\Strategy;

use Clio\Component\Normalizer\Context;
use Clio\Component\Normalizer\Type;
use Clio\Component\Type as Types;

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
	public function canNormalize($data, $type)
	{
        if($type instanceof Type) {
            return $type->isType('DateTime');
        }
        return 'DateTime'  == (string)$type;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type)
	{
        if($type instanceof Type) {
            return $type->isType('DateTime');
        }
        return 'DateTime' == (string)$type;
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
