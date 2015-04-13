<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * FieldAccessorChain 
 *   FieldAccessorChain is a ProxyFieldAccessor.
 *   This do not has the logic to access, but build ChainedFieldAccessor with accessor components. 
 *   FieldAccessorChain is the actual strategy to access via MultiFieldSchemaAccessor.
 * 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldAccessorChain extends ProxyFieldAccessor 
{
    /**
     * accessors 
     * 
     * @var mixed
     * @access private
     */
    private $accessors;

    /**
     * _root 
     * 
     * @var mixed
     * @access private
     */
    private $_root;

    /**
     * __construct 
     * 
     * @param array $accessors 
     * @access public
     * @return void
     */
    public function __construct(array $accessors = array())
    {
        $this->accessors = array();
        foreach($accessors as $accessor) {
            $this->addFieldAccessor($accessor);
        }
    }

    /**
     * getBaseAccessor 
     * 
     * @access public
     * @return void
     */
    public function getBaseAccessor()
    {
        $root = null;
        if(!$this->_root) {
            $collectionAccessor = null;
            // build 
            foreach($this->accessors as $accessor) {
                $chained = null;
                if($accessor instanceof SingleFieldAccessor) {
                    if(!$collectionAccessor) {
                        $collectionAccessor = new ChainedFieldAccessor(new Collection());
                    }

                    // add SingleFieldAccessor into Collection
                    $collectionAccessor->getFieldAccessor()->addFieldAccessor($accessor);
                } else if($accessor instanceof MultiFieldAccessor) {
                    $chained = new ChainedFieldAccessor($accessor);
                }

                if($chained) {
                    if(!$root) {
                        $root = $chained;
                    } else {
                        $root->append($chained);
                    }
                }
            }

            if($collectionAccessor) {
                if($root) {
                    $collectionAccessor->append($root);
                }
                $root = $collectionAccessor;
            }

            $this->_root = $root;
        }

        return $this->_root;
    }

    /**
     * addAccessor 
     * 
     * @param FieldAccessor $accessor 
     * @access public
     * @return FieldAccessorChain 
     */
    public function addAccessor(FieldAccessor $accessor)
    {
        $this->_root = null;
        $this->accessors[] = $accessor;

        return $this;
    }
    
    /**
     * getAccessors 
     * 
     * @access public
     * @return array<FieldAccessor> 
     */
    public function getAccessors()
    {
        return $this->accessors;
    }
    
    /**
     * setAccessors 
     * 
     * @param array $accessors 
     * @access public
     * @return FieldAccessorChain
     */
    public function setAccessors(array $accessors)
    {
        $this->accessors = array();
        foreach($accessors as $accessor) {
            $this->addAccessor($accessor);   
        }
        return $this;
    }
}

