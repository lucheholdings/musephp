<?php
namespace Clio\Extra\Normalizer;

/**
 * Normalizer 
 * 
 * @uses BaseNormalizer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Normalizer extends BaseNormalizer 
{
    /**
     * normalize 
     * 
     * @access public
     * @return void
     */
	public function normalize()
	{
		$this->notify(Notifies::NormalizationBegin, array());

		$response = parent::normalize();

		$this->notify(Notifies::NormalizationEnd, array('response' => $response));

		return $response;
	}

    /**
     * notify 
     * 
     * @param mixed $name 
     * @param array $options 
     * @access public
     * @return void
     */
	public function notify($name, array $options = array())
	{
		$options[Notifies::OPTION_NORMALIZER] = $this;
		return $this->getNotifier()->notify($name, $options);
	}
}

