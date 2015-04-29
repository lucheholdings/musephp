<?php
namespace Clio\Component\Accessor\Schema;

use Clio\Component\Metadata;

/**
 * DateTimeSchemaAccessor 
 *    Access to DateTime as formatted string
 * @uses DirectSchemaAccess
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DateTimeSchemaAccessor extends DirectSchemaAccess 
{
    const OPTION_FORMAT = 'format';

    /**
     * __construct 
     * 
     * @param Metadata\Schema $schema 
     * @param array $options 
     * @access public
     * @return void
     */
    public function __construct(Metadata\Schema $schema, array $options = array())
    {
        if('DateTime' !== $schema->getType()->getName()) {
            throw new \InvalidArgumentException(sprintf('DateTimeSchemaAccessor only accept Schema with Type DateTime, but "%s" is given', $schema->getType()->getName()));
        }

        parent::__construct($schema, $options);
    }

    /**
     * get 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function get($data)
    {
        if($this->isSupportedAccess($data, self::ACCESS_TYPE_GET)) {
            throw new \RuntimeException('Invalid access');
        } 

        $format = $this->getFormat();

        return $data->format($format);
    }

    /**
     * set 
     * 
     * @param mixed $data 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function set($data, $value)
    {
        $format = $this->getFormat();

        // update timestamp
        $data->setTimestamp(\DateTime::createFromFormat($format, $value)->getTimestamp());
    }

    /**
     * isNull 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function isNull($data)
    {
        return false;
    }

    /**
     * clear 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function clear($data)
    {
        // do nothing
    }

    /**
     * getFormat 
     * 
     * @access public
     * @return void
     */
    public function getFormat()
    {
        return $this->getOption(self::OPTION_FORMAT, self::DEFAULT_FORMAT);
    }

    /**
     * setFormat 
     * 
     * @param mixed $format 
     * @access public
     * @return void
     */
    public function setFormat($format)
    {
        $this->setOption(self::OPTION_FORMAT, $format);
    }
}

