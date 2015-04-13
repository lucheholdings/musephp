<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Util\Accessor\Field as Fields;
use Clio\Component\Util\Accessor\Tool\Scalar;

/**
 * ScalarSchemaAccessor 
 * 
 * @uses DirectSchemaAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarSchemaAccessor extends DirectSchemaAccessor 
{
    /**
     * {@inheritdoc}
     */
    public function get($data)
    {
        if($data instanceof Scalar) {
            return $data->raw;
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function set($data, $value)
    {
        if(!$data instanceof Scalar) {
            throw new \InvalidArgumentException();
        }
        $data->raw = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function isNull($data)
    {
        if($data instanceof Scalar) {
            return $data->isnull();
        }
        return is_null($data);
    }

    /**
     * {@inheritdoc}
     */
    public function clear($data)
    {
        if(!$data instanceof Scalar) {
            throw new \InvalidArgumentException();
        }
        return $data->raw = null;
    }

    public function isSupportedAccess($data, $acceptType)
    {
        if($accessType == self::ACCESS_TYPE_SET) {
            return $data instanceof Scalar;
        } else if($data instanceof Scalar) {
            $data = $data->raw;
        }
        return parent::isSupportedAccess($data, $accessType);
    }
}
