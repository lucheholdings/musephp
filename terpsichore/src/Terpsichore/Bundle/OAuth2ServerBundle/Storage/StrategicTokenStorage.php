<?php
namespace Terpsichore\Bundle\OAuth2ServerBundle\Storage;

use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\StorageStrategy;
use Terpsichore\Bundle\OAuth2ServerBundle\Storage\Strategy\TokenManagerStrategy;
use Terpsichore\Bundle\OAuth2ServerBundle\Util\StorageUtil;

class StrategicTokenStorage extends StrategicStorage 
{
	/**
	 * __construct 
	 * 
	 * @param TokenManagerStrategy $strategy 
	 * @param StorageUtil $storageUtil 
	 * @access public
	 * @return void
	 */
	public function __construct(TokenManagerStrategy $strategy, StorageUtil $storageUtil = null)
	{
		parent::__construct($strategy, $storageUtil);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setStrategy(StorageStrategy $strategy)
	{
		if(!($strategy instanceof TokenManagerStrategy)) {
			throw new \InvalidArgumentException(sprintf('Invalid Strategy instance "%s" is given.', get_class($strategy)));
		}
		return parent::setStrategy($strategy);
	}
}

