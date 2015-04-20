<?php
namespace Calliope\Core\Schema\Builder;

use Erato\Core\Schema as StaticSchema;

class BasicBuilder implements Builder 
{
    private $statisSchemaRegistry;

    private $name;

    private $schemaName;

    public function __construct(StaticSchema\Registry $staticSchemaRegistry)
    {
        $this->staticSchemaRegistry = $staticSchemaRegistry;
    }

    public function getSchema()
    {
        return new Schema($this->getStaticSchema(), $this->name);
    }

    public function getStaticSchema()
    {
        if($this->staticSchema instanceof StaticSchema) {
            return $this->staticSchema;
        }

        return $this->staticSchemaRegsitry->get((string)$this->staticSchema);
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setStaticSchema($schema)
    {
        $this->staticSchema = $schema;
    }
}

