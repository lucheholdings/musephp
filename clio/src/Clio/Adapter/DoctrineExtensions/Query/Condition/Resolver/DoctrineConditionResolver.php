<?php
namespace Clio\Adapter\DoctrineExtensions\Query\Condition\Resolver;

use Clio\Component\Util\Query\Condition\Resolver\ConditionResolver as WebQueryConditionResolver;

use Clio\Adapter\DoctrineExtensions\Query\Condition as DoctrineConditions;
/**
 * DoctrineConditionResolver 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineConditionResolver implements ConditionResolver 
{
	/**
	 * conditionResolver 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $conditionResolver;

	/**
	 * classMetadata 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadata;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($classMetadata, WebQueryConditionResolver $conditionResolver = null)
	{
		$this->classMetadata = $classMetadata;
		$this->conditionResolver = $conditionResolver;
	}

	/**
	 * resolveCondition 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @param mixed $parentAlias 
	 * @access protected
	 * @return void
	 */
	public function resolveCondition($field, $value, $parentAlias = null)
	{
		$cond = null;
		$conditionResolver = $this->getConditionResolver();
		$metadata = $this->getClassMetadata();
		if(false !== ($pos = strpos($field, '.'))) {
			// Convert to AssociationCondition
			$cond = $conditionResolver->resolveCondition($field, $value);
			$fieldName = $cond->getField();
			$assocTable = substr($fieldName, 0, $pos);
			$assocField = substr($fieldName, $pos + 1);
		
			$cond = new DoctrineConditions\DoctrineAssociationCondition($assocTable, $parentAlias);
			
			$valueCond = $conditionResolver->resolveCondition($assocField, $value);
			$cond->addFieldCondition(new DoctrineConditions\DoctrineFieldCondition($valueCond->getValueCondition(), $valueCond->getField()));
		} else if($metadata->hasField($field)) {
			// Convert to DoctrineFieldCondition
			$cond = $conditionResolver->resolveCondition($field, $value);
			$cond = new DoctrineConditions\DoctrineFieldCondition($cond->getValueCondition(), $cond->getField(), $parentAlias);
		} else if($metadata->hasAssociation($field)) {
			// 
			if('tags' === $field) {
				$cond = $conditionResolver->resolveCondition($field, $value);
				$cond = new DoctrineConditions\DoctrineTagAssociationCondition('tags', $parentAlias, $cond->getValueCondition());
			}
		} else if($metadata->hasAssociation('attributes')) {
			// if(supports attributes)
			$keyCond = $conditionResolver->resolveCondition('key', $field);
			$cond = new DoctrineConditions\DoctrineAssociationCondition('attributes', $parentAlias, $keyCond);
			
			$valueCond = $conditionResolver->resolveCondition('value', $value);
			$cond->addFieldCondition(new DoctrineConditions\DoctrineFieldCondition($valueCond->getValueCondition(), $valueCond->getField()));
		} else {
			throw new \RuntimeException(sprintf('Field "%s" is not a field or an association', $field));
		}
		return $cond;
	}

    
    /**
     * Get conditionResolver.
     *
     * @access public
     * @return conditionResolver
     */
    public function getConditionResolver()
    {
		if(!$this->conditionResolver) {
			$this->conditionResolver = new WebQueryConditionResolver();
		}
        return $this->conditionResolver;
    }
    
    /**
     * Set conditionResolver.
     *
     * @access public
     * @param conditionResolver the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConditionResolver($conditionResolver)
    {
        $this->conditionResolver = $conditionResolver;
        return $this;
    }
    
    /**
     * Get classMetadata.
     *
     * @access public
     * @return classMetadata
     */
    public function getClassMetadata()
    {
        return $this->classMetadata;
    }
    
    /**
     * Set classMetadata.
     *
     * @access public
     * @param classMetadata the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadata($classMetadata)
    {
        $this->classMetadata = $classMetadata;
        return $this;
    }
}

