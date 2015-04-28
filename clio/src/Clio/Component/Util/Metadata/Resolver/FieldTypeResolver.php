<?php
namespace Clio\Component\Util\Metadata\Resolver;
use Clio\Component\Util\Metadata\Resolver;

/**
 * FieldTypeResolver 
 *    
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FieldTypeResolver implements Resolver 
{
    static public function parseString($resource)
    {
		if(!is_string($resource)) {
			throw new \InvalidArgumentException(sprintf('$resource must to be a string, but %s is given.', gettype($resource)));
		}
		$matches = array();
		if(!preg_match('/^(?P<name>[a-zA-Z0-9\\\_]+)(\<(?P<internal_types>.+)\>)?(?P<options>\{.*\})?$/', $resource, $matches)) {
			throw new \InvalidArgumentException(sprintf('Invalid format of type "%s"', $resource));
		}

		$options = array();
		if(isset($matches['options'])) {

			$options = json_decode($matches['options']);
		}

		if(isset($matches['internal_types']) && !empty($matches['internal_types'])) {
            try {
                $options['internal_types'] = self::parseInternalTypes($matches['internal_types']);
            } catch(\InvalidArgumentException $ex) {
                throw new \InvalidArgumentException(sprintf('Invalid format of type "%s"'), 0, $ex);
            }
		}
        return array('name' => $matches['name'], 'options' => $options);
    }

    static public function parseInternalTypes($string)
    {
        $types = array();
        $pos = 0;
        $depth = 0;
        $begin = 0;
        $len = strlen($string);
        for($pos; $pos < $len; $pos++) {
            switch($string[$pos]) {
            case '<':
            case '{':
                $depth++;
                break;
            case '>':
            case '}':
                $depth--;
                break;
            case ',':
                if(0 == $depth) {
                    $types[] = trim(substr($string, $begin, $pos - $begin));
                    $begin = $pos + 1;
                }
                break;
            default:
                break;
            }
        }
        $types[] = substr($string, $begin, $pos - $begin);

        return $types;
    }

    /**
     * __construct 
     * 
     * @param Resolver $baseResolver 
     * @access public
     * @return void
     */
    public function __construct(Resolver $baseResolver)
    {
        $this->baseResolver = $baseResolver;
    }

    /**
     * resolve 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function resolve($resource)
    {
        if(is_string($resource)) {
            $components = $this->parseString($resource);
            $type = $components['name'];
        } else {
            $type = $resource;
        }
        return $this->baseResolver->resolve($type);
    }

    /**
     * resolveOptions 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function resolveOptions($resource)
    {
        if(is_string($resource)) {
            $components = $this->parseString($resource);
            return $components['options'];
        } else {
            return array();
        }
    }
}

