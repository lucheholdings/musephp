<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\ObjectType;
use Clio\Component\Tool\Normalizer\Type;

/**
 * DateTimeStrategy
 * 
 * @uses AbstractNormalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DateTimeStrategy extends ObjectStrategy 
{
	const DEFAULT_FORMAT = 'Y-m-d H:i:s';

	private $format;

	public function __construct($format = self::DEFAULT_FORMAT)
	{
		$this->format = $format;
	}

	protected function doNormalize($data, Type $type, Context $context)
	{
		if($type->hasOption('format')) {
			$format = $type->getOption('format');
		} else {
			$format = $this->getFormat();
		}

		$data->format($format);

		return $data;
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if($type->hasOption('format')) {
			$format = $type->getOption('format');
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
		return ($type instanceof ObjectType) && $type->getClassReflector()->isSubclassOf('DateTime');
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType) && $type->getClassReflector()->isSubclassOf('DateTime');
	}
}
