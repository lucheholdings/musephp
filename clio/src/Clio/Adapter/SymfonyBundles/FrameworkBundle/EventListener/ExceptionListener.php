<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\EventListener;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Clio\Component\Web;

class ExceptionListener implements EventSubscriberInterface
{
    /**
     * onKernelException 
     * 
     * @param GetResponseForExceptionEvent $event 
     * @access public
     * @return void
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
		$exception = $event->getException();
		if($exception instanceof Http\Exception) {
			// Convert to Symfony HttpException
			$exception = new HttpException($exception->getHttpStatusCode(), $exception->getMessage(), $exception);
		} else if ($exception instanceof ExceptionCollection) {
			$exception = new HttpException(500, $exception->getFlattenMessage(), $exception);
		}

		$event->setException($exception);
	}

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::EXCEPTION => array('onKernelException', 128),
        );
    }
}

