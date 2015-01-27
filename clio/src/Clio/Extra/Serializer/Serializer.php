<?php
namespace Clio\Extra\Serializer;

use Clio\Component\Tool\Serializer\Serializer as BaseSerializer;

use Clio\Component\Util\Notify\Notifier,
	Clio\Component\Util\Notify\NullNotifier
;

/**
 * Serializer 
 * 
 * @uses BaseSerializer
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Serializer extends BaseSerializer 
{
	/**
	 * notifier 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $notifier;

	/**
	 * __construct 
	 * 
	 * @param Strategy $strategy 
	 * @param ContextFactory $contextFactory 
	 * @param Dispatcher $notifier 
	 * @access public
	 * @return void
	 */
	public function __construct(Strategy $strategy, ContextFactory $contextFactory = null, Notifier $notifier = null)
	{
		parent::__construct($strategy, $contextFactory);

		$this->notifier = $notifier;
	}

	/**
	 * serialize 
	 * 
	 * @param mixed $data 
	 * @param mixed $format 
	 * @param mixed $context 
	 * @access public
	 * @return void
	 */
	public function serialize($data, $format = null, $context = null)
	{
		$this->getNotifier()->notify(Notifies::SerializationBegin, array('serializer' => $this));

		$serialized = parent::serialize($data, $format, $context);

		$this->getNotifier()->notify(Notifies::SerializationEnd, array('serializer' => $this));

		return $serialized;
	}
    
    public function getNotifier()
    {
		if(!$this->notifier) {
			$this->notifier = new NullNotifier();
		}
        return $this->notifier;
    }
    
    public function setNotifier(Notifier $notifier)
    {
        $this->notifier = $notifier;
        return $this;
    }
}

