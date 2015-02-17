<?php
namespace Clio\Extra\Normalizer;

class Normalizer extends BaseNormalizer 
{
	public function normalize()
	{
		$this->notify(Notifies::NormalizationBegin, array());

		$response = parent::normalize();

		$this->notify(Notifies::NormalizationEnd, array('response' => $response));

		return $response;
	}

	public function notify($name, array $options = array())
	{
		$options[Notifies::OPTION_NORMALIZER] = $this;
		return $this->getNotifier()->notify($name, $options);
	}
}

