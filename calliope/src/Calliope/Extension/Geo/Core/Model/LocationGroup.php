<?php
namespace Calliope\Extension\Geo\Core\Model;

class LocationGroup implements LocationGroupInterface
{
	protected $id;

	protected $locations;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getLocations()
    {
        return $this->locations;
    }
    
    public function setLocations($locations)
    {
        $this->locations = $locations;
        return $this;
    }
}

