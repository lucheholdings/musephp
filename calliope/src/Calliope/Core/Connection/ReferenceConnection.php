<?php
namespace Calliope\Core\Connection;

use Calliope\Core\Manager\ManagerInterface;

/**
 * ReferenceConnection 
 *    ConnectTo another Manager.
 * 
 * 
 * @uses Connection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ReferenceConnection extends AbstractConnection 
{
	/**
	 * __construct 
	 * 
	 * @param ManagerInterface $connectTo 
	 * @access public
	 * @return void
	 */
	public function __construct(ManagerInterface $connectTo = null, array $options = array())
	{
		parent::__construct($connectTo, $options);
	}

	/**
	 * create 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function create($model)
	{
		$response = $this->getConnectTo()->create($this->getConnectTo()->schemify($model));

		return $this->getConnectFrom()->schemify($response);
	}

	/**
	 * delete 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function delete($model)
	{
		return $this->getConnectTo()->delete($this->getConnectTo()->schemify($model));
	}

	/**
	 * update 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function update($model)
	{
		$response = $this->getConnectTo()->update($this->getConnectTo()->schemify($model));
		return $this->getConnectFrom()->schemify($response);
	}

	/**
	 * reload 
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function reload($model)
	{
		$rawModel = $this->getConnectTo()->schemify($model);

		return $this->getConnectFrom()->schemify($this->getConnectTo()->reload($rawModel));
	}

	/**
	 * findBy
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$models = $this->getConnectTo()->findBy($criteria, $orderBy, $limit, $offset);
		
		$schemifier = $this->getConnectFrom();
		$models->map(function($model) use ($schemifier) {
			return $schemifier->schemify($model);
		});

		return $models;
	}

	/**
	 * findOneBy
	 * 
	 * @param $metadata 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$model = $this->getConnectTo()->findOneBy($criteria, $orderBy);
		
		$schemifier = $this->getConnectFrom();
		return $schemifier->schemify($model);
	}

	/**
	 * countBy 
	 * 
	 * @param array $criteria 
	 * @access public
	 * @return void
	 */
	public function countBy(array $criteria) 
	{
		return $this->getConnectTo()->countBy($criteria);
	}

	/**
	 * validateConnectTo 
	 * 
	 * @param mixed $connectTo 
	 * @access protected
	 * @return void
	 */
	protected function validateConnectTo($connectTo)
	{
		return ($connectTo instanceof ManagerInterface);
	}
}

