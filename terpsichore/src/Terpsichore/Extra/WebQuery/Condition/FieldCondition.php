<?php
namespace Terpsichore\Extra\WebQuery\Condition;

class FieldCondition implements FieldValueCondition
{
	/**
	 * field 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $field;

	/**
	 * valueCondition 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $valueCondition;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($field, FieldValueCondition $condition = null)
	{
		$this->field = $field;
		$this->valueCondition= $condition;
	}
    
    /**
     * Get field.
     *
     * @access public
     * @return field
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * Set field.
     *
     * @access public
     * @param field the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
    
    /**
     * Get valueCondition.
     *
     * @access public
     * @return valueCondition
     */
    public function getValueCondition()
    {
        return $this->valueCondition;
    }
    
    /**
     * Set valueCondition.
     *
     * @access public
     * @param valueCondition the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setValueCondition($valueCondition)
    {
        $this->valueCondition = $valueCondition;
        return $this;
    }
}

