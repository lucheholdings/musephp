<?php
namespace Calliope\Core\Schema;

use Erato\Core\Schema\Manager as EratoManager;
use Calliope\Core\Connection;

/**
 * Manager 
 * 
 * @uses EratoManager
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Manager extends EratoManager 
{
    /**
     * countBy 
     * 
     * @param array $criteria 
     * @access public
     * @return void
     */
    function countBy(array $criteria);

    /**
     * findOneBy 
     * 
     * @param array $criteria 
     * @param array $orderBy 
     * @access public
     * @return void
     */
    function findOneBy(array $criteria, array $orderBy = array());

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
    function findBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null);

    /**
     * create 
     * 
     * @param mixed $model 
     * @access public
     * @return void
     */
    function create($model);

    /**
     * update 
     * 
     * @param mixed $model 
     * @access public
     * @return void
     */
    function update($model);

    /**
     * delete 
     * 
     * @param mixed $model 
     * @access public
     * @return void
     */
    function delete($model);

    /**
     * setConnection 
     * 
     * @param Connection $connection 
     * @access public
     * @return void
     */
    function setConnection(Connection $connection);
    
    /**
     * getConnection 
     * 
     * @access public
     * @return void
     */
    function getConnection();

    /**
     * getSchema 
     * 
     * @access public
     * @return void
     */
    function getSchema();
}

