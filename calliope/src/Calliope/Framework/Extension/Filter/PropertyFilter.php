<?php
namespace Calliope\Framework\Extension\Filter;

use Calliope\Framework\Core\Filter\Condition\PreFetchCondition;
use Calliope\Framework\Core\Filter\Condition\ModelCondition;

class PropertyFilter 
{
	private $field;
	
	private $value;

	private $readOnly;

	private $setter;

	public function __construct($field, $value, $readOnly = false, $setter = null)
	{
		$this->field = $field;
		$this->value = $value;

		$this->readOnly = $readOnly;
		$this->setter = $setter;
	}

	public function onPreFetch(PreFetchCondition $fetchCondition)
	{
		$criteria = $fetchCondition->getCriteria();

		$criteria[$this->getField()] = $this->getValue();

		$fetchCondition->setCriteria($criteria);
	}

	public function onPreSave(ModelCondition $condition)
	{
		if(!$this->readOnly) {
			//
			$model = $condition->getModel();

			$model->{$this->getSetter()}($this->getValue());

			$condition->setModel($model);
		}
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
    
    public function getSetter()
    {
		if(!$this->setter) {
			throw new \RuntimeException('Setter is not specified for PropertyFilter.');
		}
        return $this->setter;
    }
    
    public function setSetter($setter)
    {
        $this->setter = $setter;
        return $this;
    }
}

