<?php
namespace Clio\Component\Util\Metadata\Exception;

use Clio\Component\Util\Metadata\Exception;
use Clio\Component\Util\Metadata\SchemaMetadata;

/**
 * UnknownFieldException 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class UnknownFieldException extends \OutOfRangeException implements Exception 
{
	private $schema;

	private $fieldname;

	public function __construct($message = '', SchemaMetadata $schema = null, $fieldname = null, $code = 0, \Exception $prev = null)
	{
		$this->schema = $schema;
		$this->fieldname = $fieldname;

		parent::__construct($message, $code, $prev);
	}
    
    public function getSchema()
    {
        return $this->schema;
    }
    
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }
    
    public function getFieldname()
    {
        return $this->fieldname;
    }
    
    public function setFieldname($fieldname)
    {
        $this->fieldname = $fieldname;
        return $this;
    }
}

