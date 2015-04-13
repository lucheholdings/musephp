<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Field as Fields;

/**
 * DirectSchemaAccessor 
 * 
 * @uses AbstractSchemaAccessor
 * @uses Fields
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class DirectSchemaAccessor extends AbstractSchemaAccessor implements Fields\SingleFieldAccessor
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
