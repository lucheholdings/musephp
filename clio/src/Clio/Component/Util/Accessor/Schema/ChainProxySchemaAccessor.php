<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\SchemaAccessor;

class ChainProxySchemaAccessor implements SchemaAccessor
{
	
	private $sourceAccessor;
	
	private $nextAccessor;
	
	public function __construct(SchemaAccessor $sourceAccessor, SchemaAccessor $nextAccessor)
	{
		$this->sourceAccessor = $sourceAccessor;
		$this->nextAccessor = $nextAccessor;
	}
	
    
    
    public function getNextAccessor()
    {
		if(!$this->nextAccessor) {
			throw new \OutOfRangeException('Next Accessor is not exists.');
		}
        return $this->nextAccessor;
    }
    
    
    public function setNextAccessor(SchemaAccessor $nextAccessor)
    {
        $this->nextAccessor = $nextAccessor;
        return $this;
    }
    
    
    public function getSourceAccessor()
    {
        return $this->sourceAccessor;
    }
    
    
    public function setSourceAccessor($sourceAccessor)
    {
        $this->sourceAccessor = $sourceAccessor;
        return $this;
    }
}
