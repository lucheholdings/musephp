<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Field as Fields;

/** 
 * 
 */
abstract class DirectSchemaAccessor extends AbstractSchemaAccessor extends Fields\SingleFieldAccessor
{

    /**
     * {@inheritdoc}
     */
    public function getFieldName()
    {
        return $this->getSchema()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function isSupportedAccess($data, $accessType)
    {
        return $this->getSchema()->isValidData($data);
    }
}
