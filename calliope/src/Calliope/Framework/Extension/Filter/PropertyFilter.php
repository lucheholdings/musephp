<?php
namespace Calliope\Framework\Extension\Filter;

use Calliope\Framework\Core\Filter\Condition\PreFetchCondition;

class PropertyFilter 
{
	private $field;
	
	private $value;

	public function __construct($field, $value)
	{
		$this->field = $field;
		$this->value = $value;
	}

	public function onPreFetch(PreFetchCondition $fetchCondition)
	{
		$criteria = $fetchCondition->getCriteria();

		$criteria[$this->getField()] = $this->getValue();

		$fetchCondition->setCriteria($criteria);
	}

	public function preSave(ModelFilterCondition $condition)
	{
		//
	}
    
    public function getField()
    {
        return $this->field;
    }
    
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}

