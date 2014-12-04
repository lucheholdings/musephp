<?php
namespace Calliope\Core\Connection;

use Clio\Component\Pattern\Registry\Registry;
use Calliope\Core\Manager;

/**
 * UsecaseConnection 
 * 
 * @uses AbstractConnection
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class UsecaseConnection extends AbstractConnection implements CRUDConnection 
{
	private $registry;

	/**
	 * __construct 
	 * 
	 * @param Registry $registry 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Registry $registry, $connectTo, array $options = array())
	{
		$this->registry = $registry;

		parent::__construct($connectTo, $options);
	}

	/**
	 * doConnect 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doConnect()
	{
		if(is_string($this->connectTo)) {
			$toSchema = $this->getRegistry()->get($this->connectTo);

			$this->connectTo = $toSchema->getMapping('schema_manager')->getManager();
		}

		if(!$this->connectTo instanceof Manager) {
			throw new \InvalidArgumentException(sprintf('Invalid destination. Destination of UsecaseConnection has to be a Manager, but "%s" is given.', is_object($this->connectTo) ? get_class($this->connectTo) : gettype($this->connectTo)));
		}
	}
    
    public function getRegistry()
    {
        return $this->registry;
    }
    
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
        return $this;
    }

	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$models = $this->getConnectTo()->findBy($criteria, $orderBy, $limit, $offset);

		$schemifier = $this->getConnectFrom();

		return $models->map(function($model) use ($schemifier) {
			return $schemifier->schemify($model);
		});
	}

	public function findOneBy(array $criteria, array $orderBy = null)
	{
		$model = $this->getConnectTo()->findOneBy($criteria, $orderBy);
		
		$schemifier = $this->getConnectFrom();
		return $schemifier->schemify($model);
	}

	public function reload($model)
	{
		$response = $this->getConnectTo()->reload($this->getConnectTo()->schemify($model));
		if($response) {
			$response = $this->getConnectFrom()->schemify($response);
		}
		return $response;
	}

	public function create($model)
	{
		$response = $this->getConnectTo()->create($this->getConnectTo()->schemify($model));

		if($response) {
			return $this->getConnectFrom()->schemify($response);
		}
		return $response;
	}

	public function update($model)
	{
		$response = $this->getConnectTo()->update($this->getConnectTo()->schemify($model));

		if($response) {
			return $this->getConnectFrom()->schemify($response);
		}
		return $response;
	}

	public function delete($model)
	{
		return $this->getConnectTo()->delete($this->getConnectTo()->schemify($model));
	}

	public function countBy(array $criteria) 
	{
		return $this->getConnectTo()->countBy($criteria);
	}
}

