<?php
namespace Calliope\Framework\Client\Connection;

use Calliope\Framework\Core\Connection;
use Calliope\Framework\Client\DelegateClient;

/**
 * DelegateClientConnection
 * 
 * @uses Connection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DelegateClientConnection extends AbstractConnection implements Connection
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
		return $this->getClient()->createOn($this->getTable(), $model);
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
		return $this->getClient()->deleteOn($this->getTable(), $model->getIdentifier());
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
		return $this->getClient()->updateOn($this->getTable(), $model);
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
		return $this->findOneByOn($this->getTable(), array('hash' => $model->getHash()));
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
		$models = $this->getClient()->findByOn($this->getTable(), $criteria, $orderBy, $limit, $offset);
		
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
		$model = $this->getClient()->findOneByOn($this->getTable(), $criteria, $orderBy);
		
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
		return $this->getClient()->countByOn($this->getTable(), $criteria);
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
	 * getTable 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTable()
	{
		return $this->table;
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
		return ($connectTo instanceof DelegateClient);
	}
}

