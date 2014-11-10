<?php
namespace Calliope\Framework\Extension\Filter;

use Calliope\Framework\Core\Filter\Condition\PreFetchFilterCondition;
use Calliope\Framework\Core\Filter\Condition\ModelFilterCondition;

/**
 * TagFilter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagFilter 
{
	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tags;

	/**
	 * __construct 
	 * 
	 * @param mixed $tags 
	 * @access public
	 * @return void
	 */
	public function __construct($tags)
	{
		$this->tags = (array)$tags;
	}

	/**
	 * preFetch 
	 * 
	 * @param PreFetchFilterCondition $fetchCondition 
	 * @access public
	 * @return void
	 */
	public function preFetch(PreFetchFilterCondition $fetchCondition)
	{
		$criteria = $fetchCondition->getCriteria();
		if(isset($criteria['tags'])) {
			foreach($this->tags as $tag) {
				$criteria['tags'][] = $tag;
			}
		} else {
			$criteria['tags'] = $this->tags;
		}

		$criteria['tags'] = array_unique($criteria['tags']);
		$fetchCondition->setCriteria($criteria);
	}

	/**
	 * preSave 
	 * 
	 * @param ModelFilterCondition $condition 
	 * @access public
	 * @return void
	 */
	public function preSave(ModelFilterCondition $condition)
	{
		//
		$model = $condition->getModel();
		if($model instanceof TagSetAware) {
			//
		}
	}
}

