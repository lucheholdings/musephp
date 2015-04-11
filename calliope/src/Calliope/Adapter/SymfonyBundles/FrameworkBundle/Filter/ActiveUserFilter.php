<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Filter;

use Symfony\Component\Security\Core\SecurityContext;

// todo: condition namespaces are not defined.
use Calliope\Framework\Core\Filter\Condition\PreFetchCondition,
	Calliope\Framework\Core\Filter\Condition\ModelCondition
;

class ActiveUserFilter 
{
	private $context;

	private $field;
	
	private $readOnly;

	private $setter;

	public function __construct($field, SecurityContext $context, $readOnly, $setter)
	{
		$this->field = $field;
		$this->context = $context;

		$this->readOnly = $readOnly;
		$this->setter = $setter;
	}

	public function onPreFetch(PreFetchCondition $fetchCondition)
	{
		$criteria = $fetchCondition->getCriteria();

		$criteria[$this->getField()] = $this->getUserId();

		$fetchCondition->setCriteria($criteria);
	}

	public function onPreSave(ModelCondition $condition)
	{
		if(!$this->readOnly) {
			//
			$model = $condition->getModel();

			$model->{$this->getSetter()}($this->getUser());

			$condition->setModel($model);
		}
	}

	public function getUser()
	{
		return $this->getContext()->getToken()->getUser();
	}

	public function getUserId()
	{
		return $this->getUser()->getId();
	}
    
    public function getContext()
    {
        return $this->context;
    }
    
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
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
    
    public function getReadOnly()
    {
        return $this->readOnly;
    }
    
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;
        return $this;
    }
    
    public function getSetter()
    {
        return $this->setter;
    }
    
    public function setSetter($setter)
    {
        $this->setter = $setter;
        return $this;
    }
}

