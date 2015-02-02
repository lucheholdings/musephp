<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Util\Container\Map\Map;

class DataPool extends Map 
{
	private $type;

	public function __construct(Type $type)
	{
		$this->type = $type;

		parent::__construct();
	}

	public function add($data)
	{
		if($data instanceof ReferencedValue) {
			$ids = $data->getIdentifierValues();
		} else {
			$ids = $this->getType()->getIdentifierValues($data);
		}
		
		ksort($ids);
		$key = implode('-', $ids);

		$this->set($key, $data);
		return $this;
	}

	public function getByIdentifiers(array $ids)
	{
		ksort($ids);
		$key = implode('-', $ids);

		return $this->has($key) 
			? $this->get($key) 
			: ($this->type->canReference() 
				? $this->type->createReferencedValue($ids)
				: null
			);
	}
    
    public function getType()
    {
        return $this->type;
    }
}

