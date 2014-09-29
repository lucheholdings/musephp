<?php
namespace Calliope\Framework\Client\Connection;

use Calliope\Framework\Core\Connection,
	Calliope\Framework\Core\Connection\AbstractConnection
;

use Calliope\Framework\Client\Client;

/**
 * ClientConnection
 * 
 * @uses Connection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientConnection extends AbstractConnection implements Connection
{
	/**
	 * create 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function create($model)
	{
		return $this->getClient()->create($model);
	}

	/**
	 * delete 
	 * 
	 * @param mixed $metadata 
	 * @access public
	 * @return void
	 */
	public function delete($model)
	{
		return $this->getClient()->delete($model->getIdentifier());
	}

	/**
	 * update 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function update($model)
	{
		return $this->getClient()->update($model);
	}

	/**
	 * reload 
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function reload($model)
	{
		return $this->findOneBy(array('hash' => $model->getHash()));
	}

	/**
	 * findBy
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
	{
		$models = $this->getClient()->findBy($criteria, $orderBy, $limit, $offset);
		
		$connectFrom = $this->getConnectFrom();
		$models->map(function($model) use($connectFrom) {
			return $connectFrom->schemify($model);
		});
		return $models;
	}

	/**
	 * findOneBy
	 * 
	 * @param mixed $model 
	 * @access public
	 * @return void
	 */
	public function findOneBy(array $criteria, array $orderBy = array())
	{
		$model = $this->getClient()->findOneBy($criteria, $orderBy);
		
		return $this->getConnectFrom()->schemify($model);
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
		return $this->getClient()->countBy($criteria);
	}
    
	/**
	 * getClient 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClient()
	{
		return $this->getConnectTo();
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
		return ($connectTo instanceof Client);
	}
}

