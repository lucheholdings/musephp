<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Bridge\HWIOAuth;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ResourceOwnerFactory 
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	public function createResourceOwner($type, array $options = array())
	{
		$class = $this->getOwnerClass($type);

		$owner = new $class($this->getHttpClient(), $this->getHttpUtils(), $options, $type, $this->getStorage());

		return $owner;
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

	public function getHttpClient()
	{
		return $this->getContainer()->get('hwi_oauth.http_client');
	}

	public function getStorage()
	{
		return $this->getContainer()->get('hwi_oauth.storage.session');
	}

	public function getHttpUtils()
	{
		return $this->getContainer()->get('security.http_utils');
	}

	protected function getOwnerClass($type)
	{
		$container = $this->getContainer();
		$key = 'hwi_oauth.resource_owner.' . $type . '.class';
		if(!$container->has($key)) {
			throw new \InvalidArgumentException(sprintf('HWIOAuth dose not have the type "%s" as prototype.', $type));
		}

		$class = $container->get($key);

		return $class;
	}
}

