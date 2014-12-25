<?php
namespace Clio\Component\Tool\ArrayTool\Coder;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Validator\SubclassValidator;
use Clio\Component\Exception as CoreException;

/**
 * NamedCoderCollection 
 * 
 * @uses Map
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NamedCoderCollection extends Map implements Encoder, Decoder
{
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer(array());

		$this->setValueValidator(new SubclassValidator('Clio\Component\Tool\ArrayTool\Coder\Coder'));

		foreach($values as $key => $value) {
			$this->set($key, $value);
		}
	}

	public function encode(array $data, $format = null)
	{
		if(!$format)
			throw new \InvalidArgumentException('NamedCoderCollection::encode requires $format to specify encoder.');
		if(!$this->has($format))
			throw new CoreException\UnsupportedException(sprintf('NamedCoderCollection::encode does not support format "%s".', (string)$format));

		return $this->get($format)->encode($data);
	}

	public function decode($data, $format = null)
	{
		if(!$format)
			throw new \InvalidArgumentException('NamedCoderCollection::decode requires $format to specify encoder.');
		if(!$this->has($format))
			throw new CoreException\UnsupportedException(sprintf('NamedCoderCollection::decode does not support format "%s".', (string)$format));

		return $this->get($format)->decode($data);
	}
}

