<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Util\Container\Map\Map;

class DataPool extends Map 
{
	private $type;

	public function __construct(Type $type)
	{
		$this->type = $type;
	}

	public function add($data)
	{
		$ids = $this->getType()->getIdentifierValues($data);
		
		$key = implode('-', $ids);

		$this->set($key, $data);
	}

	public function getByIdentifiers(array $ids)
	{
		$key = implode('-', $ids);

		return $this->hasKey($key) ? $this->get($key) : null;
	}
    
    public function getType()
    {
        return $this->type;
    }
}

