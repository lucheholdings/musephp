<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Schema\Registry as SchemaRegistry;
use Calliope\Core\Schmea\Manager as SchemaManager;

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
    /**
     * schemaSchemaRegistry 
     *   SchemaRegistry to get destination schema 
     * @var mixed
     * @access private
     */
	private $schemaSchemaRegistry;

	/**
	 * __construct 
	 * 
	 * @param SchemaRegistry $schemaSchemaRegistry 
	 * @param mixed $connectTo 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaRegistry $schemaSchemaRegistry, $connectTo, array $options = array())
	{
		$this->schemaSchemaRegistry = $schemaSchemaRegistry;

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
			$toSchema = $this->getSchemaRegistry()->get($this->connectTo);

			$this->connectTo = $toSchema->getMapping('schema_manager')->getManager();
		}

		if(!$this->connectTo instanceof SchemaManager) {
			throw new \InvalidArgumentException(sprintf('Invalid destination. Destination of UsecaseConnection has to be a Manager, but "%s" is given.', is_object($this->connectTo) ? get_class($this->connectTo) : gettype($this->connectTo)));
		}
	}
    
    /**
     * getSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getSchemaRegistry()
    {
        return $this->schemaSchemaRegistry;
    }
    
    /**
     * setSchemaRegistry 
     * 
     * @param SchemaRegistry $schemaSchemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(SchemaRegistry $schemaSchemaRegistry)
    {
        $this->schemaSchemaRegistry = $schemaSchemaRegistry;
        return $this;
    }

    /**
     * findBy 
     * 
     * @param array $criteria 
     * @param array $orderBy 
     * @param mixed $limit 
     * @param mixed $offset 
     * @access public
     * @return void
     */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$models = $this->getConnectTo()->findBy($criteria, $orderBy, $limit, $offset);

		$schemifier = $this->getConnectFrom();

		return $models->map(function($model) use ($schemifier) {
			return $schemifier->schemify($model);
		});
	}

    /**
     * findOneBy 
     * 
     * @param array $criteria 
     * @param array $orderBy 
     * @access public
     * @return void
     */
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

