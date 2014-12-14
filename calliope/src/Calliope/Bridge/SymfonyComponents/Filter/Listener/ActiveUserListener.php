<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\Listener;

use Symfony\Component\Security\Core\SecurityContext;
use Clio\Component\Util\Metadata\SchemaMetadataRegistry as SchemaRegistry;

use Calliope\Bridge\SymfonyComponents\Filter\Event\FilterEvent;

/**
 * ActiveUserListener 
 * 
 * @uses BaseListener
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ActiveUserListener extends AbstractListener 
{
	private $securityContext;

	private $schemaRegistry;

	/**
	 * __construct 
	 * 
	 * @param SecurityContext $securityContext 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(SecurityContext $securityContext, SchemaRegistry $registry, array $options = array())
	{
		$this->securityContext = $securityContext;
		$this->schemaRegistry  = $registry;

		parent::__construct($options);
	}

	/**
	 * onPreFetch 
	 * 
	 * @param FilterEvent $event 
	 * @access public
	 * @return void
	 */
	public function onPreFetch(FilterEvent $event)
	{
		$criteria = $event->getRequest()->get('criteria', array());
		// 
		$mappings = $this->getOption('mapping', array());

		if(!empty($mappings)) {
			$user = $this->getActiveUser();
			if(is_object($user)) {
				$schema = $this->getSchemaFor($user);

				$accessor = $schema->getMapping('accessor')->getAccessor();

				foreach($mappings as $userField => $dataField) {
					if($accessor->existsField($user, $userField)) {
						$fieldValue = $accessor->get($user, $userField);

						// update criteira
						$criteria[$dataField] = $fieldValue;
					}
				}
			} else if(is_numeric($user)) {
				// we can only convert "id" for the user.

				foreach($mappings as $userField => $dataField) {
					if('id' === $userField) {
						$criteria[$dataField] = $user;
					}
				}
			}

			// update request criteria
			$event->getRequest()->set('criteria', $criteria);
		}
	}

	public function getSchemaFor($data)
	{
		return $this->getSchemaRegistry()->get(get_class($data));
	}

	/**
	 * getActiveUser 
	 * 
	 * @access public
	 * @return void
	 */
	public function getActiveUser()
	{
		$user = null;
		$token = $this->getSecurityContext()->getToken();

		if($token) {
			$user = $this->getSecurityContext()->getToken()->getUser();
		}


		if(!$user) {
			throw new \RuntimeException('You should filter the access by firewalls, because user is not activated.');
		}

		return $user;
	}
    
    public function getSecurityContext()
    {
        return $this->securityContext;
    }
    
    public function setSecurityContext($securityContext)
    {
        $this->securityContext = $securityContext;
        return $this;
    }
    
    public function getSchemaRegistry()
    {
        return $this->schemaRegistry;
    }
    
    public function setSchemaRegistry($schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
}

